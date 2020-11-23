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

class ClientController extends Controller
{
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

        $client = Client::create([
            'user_id'               =>  $request->user()->id,
            'first_name'            =>  $request->first_name,
            'middle_name'           =>  $request->middle_name,
            'last_name'             =>  $request->last_name,
            'address'               =>  $request->address,
            'contact_no'            =>  $request->contact_number,
            'school'                =>  $request->school,
            'course'                =>  $request->course,
        ]);
        
        foreach($request->course_id as $course) {
            $userProgram = UserProgram::create([
                'user_id'               =>  $request->user()->id,
                'program_id'            =>  $course['id'],
                'course_id'             =>  $request->program,
                'start_date'            =>  $request->start_date,
                'end_date'              =>  $request->end_date,
                'hours_needed'          =>  $request->hours_needed,
                'application_status'    =>  'New Applicant'
            ]);            
        }

        // Mail::to('staff@hospitalityinstituteofamerica.com.ph')->send(new NewApplicantNotification([
        //     'first_name'    =>  $client->first_name,
        //     'middle_name'   =>  $client->middle_name,
        //     'last_name'     =>  $client->last_name,
        //     'contact_no'    =>  $client->contact_no,
        //     'program'       =>  Program::where('id', $userProgram->program_id)->first()->name
        // ]));    

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
            'first_name'    =>  $request->first_name,
            'middle_name'   =>  $request->middle_name,
            'last_name'     =>  $request->last_name,
            'address'       =>  $request->address,
            'contact_no'    =>  $request->contact_no,
            'school'        =>  $request->school
        ]);

        Log::create([
            'user_id'   =>  $request->user()->id,
            'action'    =>  'Update personal details.'
        ]);

        return $client->with('user')->first();
    }
}
