<?php

namespace App\Http\Controllers;

use App\Client;
use App\Initial;
use App\UserProgram;
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
            'clients'   =>  Client::orderBy('created_at', 'desc')->with('userProgram')->with('course')->get()
        ]);
    }

    public function showSelectedClient($id)
    {
        $client = Client::where('user_id', $id)->with('user')->first();
        return Inertia::render('Superadmin/Client/SelectedClient', [
            'client'    =>  $client,
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
                        'client_initial'    =>  $initials->clientInitial->where('initial_id', $initials->id)->where('user_id', $id)->first()
                    ];
            }),
        ]);
    }
}
