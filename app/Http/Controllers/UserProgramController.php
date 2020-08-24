<?php

namespace App\Http\Controllers;

use App\Client;
use App\Mail\NewApplicantNotification;
use App\Program;
use App\UserProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class UserProgramController extends Controller
{
    public function addNewProgram(Request $request)
    {
        $userProgram = UserProgram::create([
            'user_id'   =>  $request->user()->id,
            'program_id'=>  $request->program_id,
            'application_status'    =>  'New Applicant'
        ]);
        
        $client = Client::where('user_id', $request->user()->id)->first();

        Mail::to('staff@hospitalityinstituteofamerica.com.ph')->send(new NewApplicantNotification([
            'first_name'    => $client->first_name,
            'middle_name'   => $client->middle_name,
            'last_name'     => $client->last_name,
            'contact_no'    => $client->contact_no,
            'program'       =>  Program::where('id', $userProgram->program_id)->first()->name
        ]));

        return redirect()->back();
    }

    public function getUserPrograms(Request $request)
    {
        $user = UserProgram::where('user_id', $request->user()->id)->get();

        return $user;
    }

    public function setApplicationStatus(Request $request, $id)
    {
        UserProgram::where('user_id', $id)
            ->where('program_id', $request->program_id)
            ->update([
                'application_status'    =>  $request->application_status
            ]);

        return redirect()->back()->with([
            'message'   =>  'Application Status Updated.'
        ]);
    }
}
