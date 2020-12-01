<?php

namespace App\Actions;

use App\Log;

class CreateLog 
{
    public function execute($data) : void
    {
        Log::create($data);
    }
}