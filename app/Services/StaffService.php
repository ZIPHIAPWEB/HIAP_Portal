<?php

namespace App\Services;

use App\Actions\CreateStaff;
use App\Actions\CreateUser;
use App\Actions\SendMailNotification;
use App\Staff;
use App\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffService
{
    private $createUser;
    private $createStaff;
    private $sendMailNotification;

    public function __construct(
        CreateUser $createUser,
        CreateStaff $createStaff,
        SendMailNotification $sendMailNotification
    )
    {
        $this->createUser = $createUser;    
        $this->createStaff = $createStaff;
        $this->sendMailNotification = $sendMailNotification;
    }

    public function add($data)
    {
        $user = $this->createUser->execute([
            'email'     =>  $data->email,
            'password'  =>  Hash::make($data->password),
            'role'      =>  'staff',
            'isFilled'  =>  1,
            'program_id'=>  0
        ]);

        $this->createStaff->execute([
            'user_id'   =>  $user->id,
            'name'      =>  $data->name,
            'school'    =>  $data->school,
            'position'  =>  $data->position,
            'contact_no'=>  $data->contact_no
        ]);

    }

    public function setActive($data)
    {
        User::where('id', $data)->update([
            'email_verified_at'   => Date::now()    
        ]);
    }

    public function remove($data)
    {
        User::where('id', $data)->delete();
        Staff::where('user_id', $data)->delete();
    }
}