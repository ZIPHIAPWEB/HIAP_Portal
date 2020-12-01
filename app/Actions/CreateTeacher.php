<?php

namespace App\Actions;

class CreateTeacher 
{
    private $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;    
    }

    public function execute()
    {
        
    }
}