<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientInitial;
use App\Grade;
use App\Log;
use App\Mail\NewApplicantNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function showApplicationForm()
    {
        return Inertia::render('Client/ApplicationForm');
    }

    public function showDashboard()
    {
        return Inertia::render('Client/Dashboard');
    }

    public function sendApplication(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'address'       =>  'required',
            'contact_number'=>  'bail|required|numeric',
            'program'    =>  'required',
        ]);

        User::find($request->user()->id)->update([
            'isFilled'      =>  true
        ]);

        $client = Client::create([
            'user_id'               =>  $request->user()->id,
            'first_name'            =>  $request->input('first_name'),
            'middle_name'           =>  $request->input('middle_name'),
            'last_name'             =>  $request->input('last_name'),
            'address'               =>  $request->input('address'),
            'contact_no'            =>  $request->input('contact_number'),
            'program_id'            =>  $request->input('program'),
            'application_status'    =>  'New Applicant'
        ]);

        Mail::to('staff@hospitalityinstituteofamerica.com.ph')->send(new NewApplicantNotification($client));

        return redirect()->route('cl.dashboard');
    }

    public function getLoggedClientDetails(Request $request)
    {
        return Client::where('user_id', $request->user()->id)
            ->with('user')
            ->with('program')
            ->first();
    }

    public function getAllClientDetails()
    {
        return Client::orderBy('created_at', 'desc')
            ->with('programs')
            ->get();
    }

    public function setApplicationStatus(Request $request, $id)
    {
        Client::where('user_id', $id)->update([
            'application_status'    =>  $request->application_status
        ]);

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
        $client = Client::where('user_id', $request->user()->id);
        $client->update([
            'first_name'    =>  $request->input('first_name'),
            'middle_name'   =>  $request->input('middle_name'),
            'last_name'     =>  $request->input('last_name'),
            'address'       =>  $request->input('address'),
            'contact_no'    =>  $request->input('contact_no'),
        ]);

        Log::create([
            'user_id'   =>  $request->user()->id,
            'action'    =>  'Update personal details.'
        ]);

        return $client->with('user')->with('program')->first();
    }
}
