<?php

namespace App\Actions;

use App\Staff;

class CreateStaff
{
    public function execute($data)
    {
        return Staff::create($data);
    }
}