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

    public function createClientApplication(object $request) : bool
    {
        $client = $this->createClient->execute([
            'user_id'               =>  $request->user()->id,
            'first_name'            =>  $request->first_name,
            'middle_name'           =>  $request->middle_name,
            'last_name'             =>  $request->last_name,
            'address'               =>  $request->address,
            'course'                =>  $request->course,
            'school_year'           =>  $request->school_year,
            'contact_no'            =>  $request->contact_number,
            'school_id'             =>  $request->school,
            'course'                =>  $request->course,
            'fb_link'               =>  $request->fb_link,
            'program_id'            =>  $request->user()->program_id,
            'alternate_email'       =>  $request->alternate_email
        ]);
        
        foreach($request->course_id as $course) {
            $this->createClientProgram->execute([
                'user_id'               =>  $request->user()->id,
                'program_id'            =>  $course['id'],
                'course_id'             =>  $request->user()->program_id,
                'start_date'            =>  $request->start_date,
                'end_date'              =>  $request->end_date,
                'hours_needed'          =>  $request->hours_needed,
                'application_status'    =>  'New Learner'
            ]);
        }

        Notification::route('mail', 'info@hospitalityinstituteofamerica.com.ph')
            ->notify(new NewApplicantRegistered([
                'first_name'    =>  $client->first_name,
                'middle_name'   =>  $client->middle_name,
                'last_name'     =>  $client->last_name,
                'contact_no'    =>  $client->contact_no,
                'program'       =>  OnlineProgram::where('id', $request->user()->program_id)->first()->name,
                'school'        =>  School::where('id', $client->school_id)->first()->name
            ]));
        // (new SendMailNotification)->execute('info@hospitalityinstituteofamerica.com.ph', new NewApplicantNotification([
        //     'first_name'    =>  $client->first_name,
        //     'middle_name'   =>  $client->middle_name,
        //     'last_name'     =>  $client->last_name,
        //     'contact_no'    =>  $client->contact_no,
        //     'program'       =>  OnlineProgram::where('id', $request->user()->program_id)->first()->name,
        //     'school'        =>  School::where('id', $client->school_id)->first()->name
        // ]));

        if(isset($client)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateApplicationStatus(string $status, int $userId) : void
    {
        $this->updateClient->execute(['user_id' => $userId], ['application_status' => $status]);
    }

    public function updateDetails($request)
    {
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
            'alternate_email'       =>  $request->alternate_email
        ]);

        switch($request->user()->role) {
            case 'client':
                (new CreateLog)->execute([
                    'user_id' => $request->user()->id,
                    'action'  => 'Update personal details'
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

    public function getClientRecords(string $sortBy = 'desc') : Client
    {
        return Client::orderBy('created_at', $sortBy)->with('programs')->get();
    }
}