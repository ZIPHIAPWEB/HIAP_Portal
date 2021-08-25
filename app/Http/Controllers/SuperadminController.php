<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientInitial;
use App\Initial;
use App\OnlineProgram;
use App\Payment;
use App\Program;
use App\School;
use App\Staff;
use App\User;
use App\UserProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'clients'       =>  User::orderBy('email_verified_at', 'asc')
                                    ->withCount('client')
                                    ->where('role', 'client')
                                    ->paginate(15),
            'total_clients' =>  User::where('role', 'client')
                                    ->count(),
            'unverified'    =>  User::where('role', 'client')
                                    ->whereNull('email_verified_at')
                                    ->count(),
            'verified'      =>  User::where('role', 'client')
                                    ->whereNotNull('email_verified_at')
                                    ->count(),
            'isFilled'      =>  User::where('role', 'client')
                                    ->where('isFilled', 1)
                                    ->count()
        ]);
    }

    public function showSelectedClient($id)
    {
        $client = Client::where('user_id', $id)
            ->with('user')
            ->with('school')
            ->first();
            
        return Inertia::render('Superadmin/Client/SelectedClient', [
            'client'                =>  $client,
            'initials'              =>  Initial::orderBy('id', 'asc')
                ->with(['clientInitial' => function ($query) use ($client) {
                    return $query->where('user_id', $client->user_id);
                }])
                ->get()
                ->map(function ($initial) {
                    return [
                        'id'                =>  $initial->id,
                        'name'              =>  $initial->name,
                        'client_initial'    =>  $initial->clientInitial
                    ];
                }),
            'schools'               =>  School::orderBy('name', 'asc')->get(),
            'online_programs'       =>  OnlineProgram::orderBy('name', 'asc')->get(),
            'courses'               =>  Program::where('isActive', 1)->orderBy('name', 'asc')->get(),
            'payments'              =>  Payment::where('user_id', $id)->get()->map(function($payment) {
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

    public function searchClientByEmail(Request $request)
    {
        return  User::orderBy('email_verified_at', 'asc')
                    ->withCount('client')
                    ->where('role', 'client')
                    ->where('email', 'like', '%'.$request->email.'%')
                    ->paginate(15);
    }
}
