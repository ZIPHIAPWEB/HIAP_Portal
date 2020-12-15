<?php

namespace App\Actions;

use App\Client;

class CreateClient {
   
    public function execute($data) : Client
    {
        return Client::create($data);
    }
}