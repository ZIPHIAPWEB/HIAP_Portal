<?php

namespace App\Http\Controllers;

use App\Client;
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

        return redirect()
            ->back()
            ->with('message', 'Payment will be verified by the accounting department.');
    }

    public function payBySchool(Request $request)
    {
        $this->paymentService->payBySchool($request);

        return redirect()
            ->back()
            ->with('message', 'Payment will be verified by the accounting department.');
    }

    public function removeDepositSlip($slipId)
    {
        $this->paymentService->deleteDepositSlip($slipId);

        return redirect()
            ->back()
            ->with('message', 'Deposit slip removed.');
    }
}
