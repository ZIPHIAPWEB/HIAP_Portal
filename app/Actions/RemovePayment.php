<?php

namespace App\Actions;

use App\Payment;

class RemovePayment
{
    private $temp;

    public function execute($where)
    {
        $selectedPayment = Payment::where($where)->first();
        $this->temp = $selectedPayment;
        $selectedPayment->delete();

        return $this->temp;
    }
}