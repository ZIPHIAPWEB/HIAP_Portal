<?php

namespace App\Services;

use App\Actions\CreateUserProgram;
use App\Actions\RemoveUserProgram;
use App\Actions\SendMailNotification;
use App\Actions\UpdateUserProgram;
use App\Client;
use App\Mail\NewApplicantNotification;

class UserProgramService 
{
    private $createUserProgram;
    private $sendMailNotification;
    private $removeUserProgram;
    private $updateUserProgram;

    public function __construct(
        CreateUserProgram $createUserProgram,
        UpdateUserProgram $updateUserProgram, 
        RemoveUserProgram $removeUserProgram,
        SendMailNotification $sendMailNotification
    )
    {
        $this->createUserProgram = $createUserProgram;
        $this->sendMailNotification = $sendMailNotification;
        $this->removeUserProgram = $removeUserProgram;
        $this->updateUserProgram = $updateUserProgram;
    }

    public function saveUserProgram($data) 
    {
        foreach($data->courses as $course) {
            $this->createUserProgram->execute([
                'user_id'               =>  $data->user()->id,
                'program_id'            =>  $course['id'],
                'course_id'             =>  $data->program_id,
                'start_date'            =>  $data->start_date,
                'end_date'              =>  $data->end_date,
                'hours_needed'          =>  $data->hours_needed,
                'application_status'    => false
            ]);
        }
        // if($this->createUserProgram->execute($data)) {
        //     $client = Client::where('user_id', $data->user()->id)->first();

        //     $this->sendMailNotification->execute('staff@hospitalityinstituteofamerica.com.ph', new NewApplicantNotification([
        //         'first_name'    => $client->first_name,
        //         'middle_name'   => $client->middle_name,
        //         'last_name'     => $client->last_name,
        //         'contact_no'    => $client->contact_no,
        //         'program'       => ''
        //     ]));

        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function updateStatus($data, $userProgramId)
    {
        if($data['application_status'] == 0) {
            $this->setStatusToComplete($userProgramId);
        } else {
            $this->setStatusToUncomplete($userProgramId);
        }
    }

    private function setStatusToComplete($userProgramId)
    {
        $this->updateUserProgram->execute(['id' => $userProgramId], [
            'application_status'    =>  true
        ]);
    }

    private function setStatusToUncomplete($userProgramId)
    {
        $this->updateUserProgram->execute(['id' => $userProgramId], [
            'application_status'    =>  false
        ]);
    }

    public function removeProgram($data)
    {
        $this->removeUserProgram->execute($data);
    }
}