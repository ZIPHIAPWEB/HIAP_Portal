<?php

namespace App\Actions;

use App\UserProgram;

class CreateUserProgram 
{
    public function execute($data) : bool
    {
        if (UserProgram::where('program_id', $data->program_id)->where('user_id', $data->user()->id)->first()) {
            return false;
        } else {
            UserProgram::create([
                'user_id'               =>  $data->user()->id,
                'program_id'            =>  $data->program_id,
                'application_status'    =>  'New Applicant'
            ]);

            return true;
        }
    }
}