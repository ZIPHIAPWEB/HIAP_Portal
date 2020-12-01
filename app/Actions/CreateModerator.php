<?php

namespace App\Actions;

use App\Moderator;
use Illuminate\Support\Facades\Hash;

class CreateModerator {

    private $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;    
    }

    public function execute($data) : Moderator
    {
        $user = $this->createUser->execute([
            'email'     =>  $data->email,
            'role'      =>  'moderator',
            'password'  =>  Hash::make(strtolower(str_replace(' ', '', $data->last_name))),
            'isFilled'  =>  true
        ]);

        $moderator = Moderator::create([
            'user_id'       =>  $user->id,
            'first_name'    =>  $data->first_name,
            'middle_name'   =>  $data->middle_name,
            'last_name'     =>  $data->last_name
        ]);

        return $moderator;
    }
}