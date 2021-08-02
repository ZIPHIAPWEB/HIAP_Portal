<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\Payment\AddPaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;        
    }

    public function addDepositSlip(AddPaymentRequest $request)
    {
        
        $this->paymentService->uploadDepositSlip($request->validated());

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

    public function removeDepositSlip(Request $request, $slipId)
    {
        $this->paymentService->deleteDepositSlip($request, $slipId);

        return redirect()
            ->back()
            ->with('message', 'Deposit slip removed.');
    }
}
