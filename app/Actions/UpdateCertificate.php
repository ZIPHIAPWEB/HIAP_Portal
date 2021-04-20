<?php

namespace App\Actions;

use App\Certificate;

class UpdateCertificate 
{
    public function execute($where, $data)
    {
        return Certificate::where($where)->update($data);
    }
}