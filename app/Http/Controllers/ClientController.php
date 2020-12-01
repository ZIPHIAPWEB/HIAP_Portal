<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientInitial;
use App\Course;
use App\Grade;
use App\Log;
use App\Mail\NewApplicantNotification;
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

    public function showApplicationForm()
    {
        return Inertia::render('Client/ApplicationForm', [
            'schools'   =>  School::orderBy('name')->get(),
            'courses'   =>  Course::orderBy('id')->get(),
            'programs'  =>  Program::orderBy('id')->where('isActive', 1)->get()
        ]);
    }

    public function showDashboard(Request $request)
    {
        return Inertia::render('Client/Dashboard', [
            'userPrograms'  =>  UserProgram::where('user_id', $request->user()->id)
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
            'program'       =>  'required',
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
        
        return redirect()->back();
    }

    public function updateClientDetails(Request $request)
    {
        return $this->clientApplicationService->updateDetails($request);
    }
}
