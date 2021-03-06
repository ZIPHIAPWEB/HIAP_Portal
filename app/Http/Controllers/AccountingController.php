<?php

namespace App\Http\Controllers;

use App\Client;
use App\Payment;
use App\Services\PaymentService;
use App\UserProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AccountingController extends Controller
{
    private $payment;

    public function __construct(PaymentService $paymentService)
    {
        $this->payment = $paymentService;
    }

    public function showAccountingClients()
    {
        return Inertia::render('Accounting/Clients', [
            'clients'   =>  Client::orderBy('created_at', 'desc')
                ->with('user')
                ->with('payments')
                ->with('school')
                ->with(['userProgram' => function($query) {
                    return $query->with('program');
                }])
                ->paginate(20)
        ]);
    }

    public function showAccountingDashboard()
    {
        return Inertia::render('Accounting/Dashboard');
    }

    public function showAccountingSelectedClient($id)
    {
        $client = Client::where('user_id', $id)->with('user')->first();
        return Inertia::render('Accounting/Client/SelectedClient', [
            'client'    =>  $client,
            'payments'  =>  Payment::where('user_id', $id)->get()->map(function($payment) {
                return [
                    'id'        =>  $payment->id,
                    'user_id'   =>  $payment->user_id,
                    'purpose'   =>  $payment->purpose,
                    'paid_from'     =>  $payment->paid_from,
                    'mop'           =>  $payment->mop,
                    'date_paid'     =>  $payment->date_paid,
                    'amount_paid'   =>  $payment->amount_paid,
                    'isVerified'=>  $payment->isVerified,
                    'path'      =>  (Auth::check()) ? '/slips/' . $payment->path : 'Auth required.',
                    'created_at'=>  $payment->created_at->toDayDateTimeString(),
                    'track'         =>  [
                        'id'    =>  ($payment->track == null || $payment->track == '') ? null : $payment->track->id,
                        'name'  =>  ($payment->track == null || $payment->track == '') ? null : $payment->track->program->name
                    ],
                ];
            }),
            'userPrograms' =>  UserProgram::where('user_id', $client->user_id)
                ->with('program')
                ->with('course')
                ->get()
        ]);
    }

    public function searchStudentByLastName(Request $request)
    {
        return Client::where('last_name', 'like', '%'. $request->search .'%')
            ->orWhere('first_name', 'like' ,'%'. $request->search .'%')
            ->with('user')
            ->with('payments')
            ->with('school')
            ->with(['userProgram' => function($query) {
                return $query->with('program');
            }])
            ->paginate(50);
    }

    public function paymentVerified(Request $request)
    {
        $this->payment->verify($request->id);

        return redirect()->back();
    }
}
