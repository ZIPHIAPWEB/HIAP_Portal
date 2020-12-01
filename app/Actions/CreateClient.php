<?php

namespace App\Actions;

use App\Client;

class CreateClient {
   
    public function execute(object $data) : Client
    {
        $client = Client::create([
            'user_id'               =>  $data->user()->id,
            'first_name'            =>  $data->first_name,
            'middle_name'           =>  $data->middle_name,
            'last_name'             =>  $data->last_name,
            'address'               =>  $data->address,
            'contact_no'            =>  $data->contact_number,
            'school'                =>  $data->school,
            'course'                =>  $data->course,
        ]);
        

        return $client;
    }
}