<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientInitial;
use App\Course;
use App\Grade;
use App\Log;
use App\Mail\NewApplicantNotification;
use App\OnlineProgram;
use App\Payment;
use App\Program;
use App\School;
use App\User;
use App\UserProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Services\ClientApplicationService;

class ClientController extends Controller
{
    private $clientApplicationService;

    public function __construct(ClientApplicationService $clientApplicationService)
    {
        $this->clientApplicationService = $clientApplicationService;
    }

    public function showApplicationForm(Request $request)
    {
        return Inertia::render('Client/ApplicationForm', [
            'program_id'=>  $request->user()->program_id,
            'schools'   =>  School::orderBy('name')->get(),
            'courses'   =>  Course::orderBy('id')->get(),
            'programs'  =>  Program::orderBy('name')->where('isActive', 1)->get()
        ]);
    }

    public function showDashboard(Request $request)
    {
        return Inertia::render('Client/Dashboard', [
            'client'             =>  Client::where('user_id', $request->user()->id)
                ->with('user')
                ->with('school')
                ->first(),
            'schools'           =>  School::orderBy('name', 'desc')->get(),
            'onlinePrograms'    =>  OnlineProgram::orderBy('name', 'desc')->get(),
            'payments'          =>  Payment::where('user_id', $request->user()->id)->get()->map(function($payment) {
                return [
                    'id'            =>  $payment->id,
                    'purpose'       =>  $payment->purpose,
                    'isVerified'    =>  $payment->isVerified,
                    'created_at'    =>  $payment->created_at->toDayDateTimeString()
                ];
            }),
            'userPrograms'      =>  UserProgram::where('user_id', $request->user()->id)
                ->with('program')
                ->with('course')
                ->get()
        ]);
    }

    public function showClientRequirements($programId)
    {
        return Inertia::render('Client/UserRequirements', [
            'programId' =>  $programId
        ]);
    }

    public function sendApplication(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'address'       =>  'required',
            'contact_number'=>  'bail|required|numeric',
            'school'        =>  'required',
        ]);

        User::find($request->user()->id)->update([
            'isFilled'      =>  true
        ]);

        $this->clientApplicationService->createClientApplication($request);  

        return redirect()->route('cl.dashboard');
    }

    public function getLoggedClientDetails(Request $request)
    {
        return Client::where('user_id', $request->user()->id)
            ->with('user')
            ->with('course')
            ->first();
    }

    public function getAllClientDetails()
    {
        return $this->clientApplicationService->getClientRecords();
    }

    public function setApplicationStatus(Request $request, $id)
    {
        $this->clientApplicationService->updateApplicationStatus($request->application_status, $id);

        return redirect()->back()->with([
            'message'   =>  'Application Status Updated.'
        ]);
    }

    public function deleteClientDetails($userId)
    {
        User::find($userId)->delete();
        Client::where('user_id', $userId)->delete();
        ClientInitial::where('user_id', $userId)->delete();
        Grade::where('user_id', $userId)->delete();
        
        return redirect()
            ->back()
            ->with('message', 'Client deleted.');
    }

    public function manualVerification($userId)
    {
        User::where('id', $userId)->update([
            'email_verified_at' =>  now()
        ]);

        return redirect()->back();
    }

    public function updateClientDetails(Request $request)
    {
        $this->clientApplicationService->updateDetails($request);

        return redirect()
            ->back()
            ->with('message', 'Client details updated.');
    }
}
