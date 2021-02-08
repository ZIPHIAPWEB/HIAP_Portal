<?php

namespace App\Http\Controllers;

use App\Client;
use App\Initial;
use App\OnlineProgram;
use App\Payment;
use App\Program;
use App\Staff;
use App\UserProgram;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SuperadminController extends Controller
{
    public function showDashboard()
    {
        return Inertia::render('Superadmin/Dashboard');
    }

    public function showPrograms()
    {
        return Inertia::render('Superadmin/ProgramEntry');
    }

    public function showClients()
    {
        return Inertia::render('Superadmin/Clients', [
            'clients'   =>  Client::orderBy('created_at', 'desc')
                ->with('school')
                ->with(['userProgram' => function($query) {
                    return $query->with('program');
                }])->get()
        ]);
    }

    public function showSelectedClient($id)
    {
        $client = Client::where('user_id', $id)->with('user')->first();
        return Inertia::render('Superadmin/Client/SelectedClient', [
            'client'    =>  $client,
            'online_programs'    =>  OnlineProgram::orderBy('name', 'asc')->get(),
            'courses'           =>  Program::orderBy('name', 'asc')->get(),
            'payments'  =>  Payment::where('user_id', $id)->get()->map(function($payment) {
                return [
                    'id'        =>  $payment->id,
                    'user_id'   =>  $payment->user_id,
                    'purpose'   =>  $payment->purpose,
                    'isVerified'=>  $payment->isVerified,
                    'path'      =>  (Auth::check()) ? '/slips/' . $payment->path : 'Auth required.',
                    'created_at'=>  $payment->created_at->toDayDateTimeString()
                ];
            }),
            'userPrograms' =>  UserProgram::where('user_id', $client->user_id)
                ->with('program')
                ->with('course')
                ->get()
        ]);
    }

    public function showSelectedProgram($id, $programId)
    {
        return Inertia::render('Superadmin/Client/SelectedProgram', [
            'userProgram'=>  UserProgram::where('user_id', $id)
                ->where('program_id', $programId)
                ->first()
            ,
            'initials'   =>  Initial::where('program_id', $programId)
                ->with('clientInitial')
                ->get()
                ->map(function ($initials) use ($id) {
                    return [
                        'id'                =>  $initials->id,
                        'name'              =>  $initials->name,
                        'client_initial'    =>  $initials->clientInitial
                            ->where('initial_id', $initials->id)
                            ->where('user_id', $id)
                            ->first()
                    ];
            }),
        ]);
    }

    public function showStaffEntry()
    {
        return Inertia::render('Superadmin/StaffEntry', [
            'staffs'    =>  Staff::orderBy('created_at', 'desc')
                ->with('user')
                ->with('school')
                ->get()
        ]);
    }
}
