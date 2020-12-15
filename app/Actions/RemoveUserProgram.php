<?php

namespace App\Actions;

use App\UserProgram;

class RemoveUserProgram
{
    public function execute($data) : void
    {
        UserProgram::where(['id' => $data])->delete();
    }
}