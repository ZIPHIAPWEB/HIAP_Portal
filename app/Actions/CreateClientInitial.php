<?php

namespace App\Actions;

use App\ClientInitial;

class CreateClientInitial
{
    public function execute($data)
    {
        return ClientInitial::create($data);
    }
}