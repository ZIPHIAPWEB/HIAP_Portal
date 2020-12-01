<?php

namespace App\Actions;

use App\Client;

class UpdateClient
{

    public function execute(array $where, array $data)
    {
        $client = Client::where($where);
        $client->update($data);

        return $client;
    }
}