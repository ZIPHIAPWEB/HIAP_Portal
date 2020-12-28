<?php

namespace App\Actions;

use App\Payment;

class UpdatePayment
{
    public function execute($where, $data)
    {
        Payment::where($where)->update($data);
    }
}