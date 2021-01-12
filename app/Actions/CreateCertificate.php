<?php

namespace App\Actions;

use App\Certificate;

class CreateCertificate 
{
    public function execute($data)
    {
        Certificate::create($data);
    }
}