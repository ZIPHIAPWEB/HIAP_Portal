<?php

namespace App\Actions;

use App\Certificate;

class RemoveCertificate 
{
    public function execute($id)
    {
        Certificate::find($id)->delete();
    }
}