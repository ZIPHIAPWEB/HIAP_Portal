<?php

namespace App\Actions;

use App\User;

class CreateUser
{
    public function execute($data) : User
    {
        return User::create($data);
    }
}