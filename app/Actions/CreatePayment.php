<?php

namespace App\Actions;

use App\Payment;

class CreatePayment
{
    public function execute($data)
    {
        Payment::create($data);
    }
}