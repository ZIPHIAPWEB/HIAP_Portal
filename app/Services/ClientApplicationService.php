<?php

namespace App\Services;

use App\Actions\CreateClient;
use App\Actions\CreateClientProgram;
use App\Actions\CreateLog;
use App\Actions\SendMailNotification;
use App\Actions\UpdateClient;
use App\Client;
use App\Mail\NewApplicantNotification;

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

    public function createClientApplication(object $request) : void
    {
        $client = $this->createClient->execute($request);
        
        foreach($request->course_id as $course) {
            $this->createClientProgram->execute([
                'user_id'               =>  $request->user()->id,
                'program_id'            =>  $course['id'],
                'course_id'             =>  $request->program,
                'start_date'            =>  $request->start_date,
                'end_date'              =>  $request->end_date,
                'hours_needed'          =>  $request->hours_needed,
                'application_status'    =>  'New Applicant'
            ]);
        }

        (new SendMailNotification)->execute('staff@hospitalityinstituteofamerica.com.ph', new NewApplicantNotification([
            'first_name'    =>  $client->first_name,
            'middle_name'   =>  $client->middle_name,
            'last_name'     =>  $client->last_name,
            'contact_no'    =>  $client->contact_no,
            'program'       =>  ''
        ]));
    }

    public function updateApplicationStatus(string $status, int $userId) : void
    {
        $this->updateClient->execute(['user_id' => $userId], ['application_status' => $status]);
    }

    public function updateDetails($data)
    {
        $updateClient = $this->updateClient->execute(['user_id' => $data->user()->id], [
            'first_name'    =>  $data->first_name,
            'middle_name'   =>  $data->middle_name,
            'last_name'     =>  $data->last_name,
            'address'       =>  $data->address,
            'contact_no'    =>  $data->contact_no,
            'school'        =>  $data->school
        ]);

        (new CreateLog)->execute([
            'user_id' => $data->user()->id,
            'action'  => 'Update personal details'
        ]);

        return $updateClient->with('user')->first();
    }

    public function getClientRecords(string $sortBy = 'desc') : Client
    {
        return Client::orderBy('created_at', $sortBy)->with('programs')->get();
    }
}