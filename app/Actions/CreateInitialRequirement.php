<?php

namespace App\Actions;

use App\Initial;

class CreateInitialRequirement 
{
    public function execute($data)
    {
        return Initial::create($data);
    }
}