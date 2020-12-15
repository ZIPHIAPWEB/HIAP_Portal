<?php

namespace App\Actions;

use App\UserProgram;

class UpdateUserProgram
{
    public function execute($where, $data) : void
    {
        UserProgram::where($where)->update($data);
    }
}