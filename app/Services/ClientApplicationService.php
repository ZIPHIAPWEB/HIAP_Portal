<?php

namespace App\Services;

use App\Actions\CreateClient;
use App\Actions\CreateClientProgram;
use App\Actions\CreateLog;
use App\Actions\SendMailNotification;
use App\Actions\UpdateClient;
use App\Client;
use App\Mail\NewApplicantNotification;
use App\Notifications\NewApplicantRegistered;
use App\OnlineProgram;
use App\School;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ClientApplicationService {

    private $createClient;
    private $updateClient;
    private $createClientProgram;

    public function __construct(
        CreateClient $createClient, 
        UpdateClient $updateClient,
        CreateClientProgram $createClientProgram,
        CreateLog $createLog
        )
    {
        $this->createClient = $createClient;
        $this->createClientProgram = $createClientProgram;
        $this->updateClient = $updateClient;
        $this->createLog = $createLog;
    }

    public function createClientApplication($request) : bool
    {
        return DB::transaction(function() use ($request) {
            $formData = [
                'user_id'               =>  $request->user()->id,
                'first_name'            =>  $request->first_name,
                'middle_name'           =>  $request->middle_name,
                'last_name'             =>  $request->last_name,
                'date_of_birth'         =>  $request->date_of_birth,
                'contact_no'            =>  $request->contact_number,
                'address'               =>  $request->address,
                'fb_link'               =>  $request->fb_link,
                'program_id'            =>  $request->user()->program_id,
                'alternate_email'       =>  $request->alternate_email,
                'affiliation'           =>  $request->affiliation,
            ];

            if ($request->affiliation == 'student') {
                $formData = array_merge($formData, [
                    'school_id'             =>  $request->school,
                    'course'                =>  $request->course,
                    'school_year'           =>  $request->school_year,
                    'section'               =>  $request->section,
                    'expected_graduation'   =>  $request->expected_graduation
                ]);
            } else {
                $formData = array_merge($formData, [
                    'industry_id' =>  $request->industry,
                    'company' => $request->company
                ]);
            }
            
            $client = $this->createClient->execute($formData);

            foreach($request->course_id as $course) {
                $this->createClientProgram->execute([
                    'user_id'               =>  $request->user()->id,
                    'program_id'            =>  $course['id'],
                    'course_id'             =>  $request->user()->program_id,
                    'start_date'            =>  $request->start_date,
                    'end_date'              =>  $request->end_date,
                    'hours_needed'          =>  $request->hours_needed,
                    'returnee'              =>  $request->returnee,
                    'application_status'    =>  'New Learner'
                ]);
            }

            if (config('settings.enable_new_applicant_notification')) {
                $notificationBaseDetails = [
                    'first_name'    =>  $client->first_name,
                    'middle_name'   =>  $client->middle_name,
                    'last_name'     =>  $client->last_name,
                    'contact_no'    =>  $client->contact_no,
                    'program'       =>  OnlineProgram::where('id', $request->user()->program_id)->first()->name,
                    'affiliation'   =>  $client->affiliation
                ];

                if ($request->affiliation == 'student') {
                    $notificationBaseDetails = array_merge($notificationBaseDetails, [
                        'school'        =>  School::where('id', $client->school_id)->first()->name
                    ]);
                } else {
                    $notificationBaseDetails = array_merge($notificationBaseDetails, [
                        'industry'     =>  $client->industry->name,
                        'company'      =>  $client->company
                    ]);
                }
                
                Notification::route(
                        'mail', 
                        'hiapinstitute.enrollment@gmail.com'
                    )->notify(
                        new NewApplicantRegistered($notificationBaseDetails)
                    );
            }

            if(isset($client)) {
                
                return true;
            } 

            return false;
        });
    }

    public function updateApplicationStatus(string $status, int $userId) : void
    {
        $this->updateClient->execute(['user_id' => $userId], ['application_status' => $status]);
    }

    public function updateDetails($request)
    {
        $isSuperadmin = $request->user()->role == 'superadministrator';

        if ($isSuperadmin) {
            User::where('id', $request->user_id)
            ->update([
                'email'     =>  $request->user['email']
            ]);
        }

        $updateClient = $this->updateClient->execute(['user_id' => $request->user_id], [
            'first_name'            =>  $request->first_name,
            'middle_name'           =>  $request->middle_name,
            'last_name'             =>  $request->last_name,
            'address'               =>  $request->address,
            'course'                =>  $request->course,
            'school_year'           =>  $request->school_year,
            'contact_no'            =>  $request->contact_no,
            'school_id'             =>  $request->school_id,
            'course'                =>  $request->course,
            'fb_link'               =>  $request->fb_link,
            'program_id'            =>  $request->program_id,
            'alternate_email'       =>  $request->alternate_email,
            'section'               =>  $request->section,
            'expected_graduation'   =>  $request->expected_graduation
        ]);


        switch($request->user()->role) {
            case 'client':
                (new CreateLog)->execute([
                    'user_id' => $request->user()->id,
                    'action'  => 'Update personal details'
                ]);        
            break;
            
            case 'moderator':
                (new CreateLog)->execute([
                    'user_id' => $request->user()->id,
                    'action'  => 'Update\'s client ' . $request->user_id .  ' details.'
                ]);        
            break;

            case 'superadministrator':
                (new CreateLog)->execute([
                    'user_id' => $request->user()->id,
                    'action'  => 'Update\'s client ' . $request->user_id .  ' details.'
                ]);        
            break;
        }
        return $updateClient->with('user')->first();
    }

    public function getClientRecords(string $sortBy = 'desc')
    {
        return Client::orderBy('created_at', $sortBy)->with('programs')->get();
    }
}