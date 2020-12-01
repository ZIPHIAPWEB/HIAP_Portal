<?php

namespace App\Services;

use App\Actions\CreateUserProgram;
use App\Actions\SendMailNotification;
use App\Client;
use App\Mail\NewApplicantNotification;

class UserProgramService 
{
    private $createUserProgram;
    private $sendMailNotification;

    public function __construct(CreateUserProgram $createUserProgram, SendMailNotification $sendMailNotification)
    {
        $this->createUserProgram = $createUserProgram;
        $this->sendMailNotification = $sendMailNotification;
    }

    public function saveUserProgram($data) : bool
    {
        if($this->createUserProgram->execute($data)) {
            $client = Client::where('user_id', $data->user()->id)->first();

            $this->sendMailNotification->execute('staff@hospitalityinstituteofamerica.com.ph', new NewApplicantNotification([
                'first_name'    => $client->first_name,
                'middle_name'   => $client->middle_name,
                'last_name'     => $client->last_name,
                'contact_no'    => $client->contact_no,
                'program'       => ''
            ]));

            return true;
        } else {
            return false;
        }
    }
}