<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;        
    }

    public function addDepositSlip(Request $request)
    {
        $this->paymentService->uploadDepositSlip($request);

        return redirect()->back();
    }

    public function removeDepositSlip($slipId)
    {
        $this->paymentService->deleteDepositSlip($slipId);

        return redirect()->back();
    }
}
