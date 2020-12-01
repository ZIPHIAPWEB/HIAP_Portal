<?php

namespace App\Actions;

use App\UserProgram;

class CreateClientProgram {

    public function execute($data) : void
    {
        UserProgram::create($data);
    }
}