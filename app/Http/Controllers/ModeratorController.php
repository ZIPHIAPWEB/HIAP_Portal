<?php

namespace App\Http\Controllers;

use App\Client;
use App\Events\UserLogCreated;
use App\Http\Requests\ModeratorCreateRequest;
use App\Initial;
use App\Moderator;
use App\Program;
use App\User;
use App\UserProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ModeratorController extends Controller
{
    public function showDashboard()
    {
        return Inertia::render('Moderator/Dashboard', [
            'programs'      =>  Program::orderBy('name', 'asc')->get(),
            'clients'       =>  UserProgram::orderBy('id', 'asc')->with('program')->get()
        ]);
    }

    public function showModeratorEntry()
    {
        return Inertia::render('Superadmin/ModeratorEntry', [
            'moderators'    =>  Moderator::orderBy('first_name', 'asc')->with('user')->get()
        ]);
    }

    public function getAllModerators()
    {
        return Moderator::orderBy('first_name', 'asc')->with('user')->get();
    }

    public function createModerator()
    {
        return Inertia::render('Superadmin/Moderator/Create');
    }

    public function storeModerator(ModeratorCreateRequest $request)
    {
        $user = User::create([
            'email'     =>  $request->email,
            'role'      =>  'moderator',
            'password'  =>  Hash::make(strtolower(str_replace(' ', '', $request->last_name))),
            'isFilled'  =>  true
        ]);

        Moderator::create([
            'user_id'       =>  $user->id,
            'first_name'    =>  $request->first_name,
            'middle_name'   =>  $request->middle_name,
            'last_name'     =>  $request->last_name
        ]);

        event(new UserLogCreated([
            'user_id'   =>  $request->user()->id,
            'action'    =>  $user->email . ' has been registered.'
        ]));
        
        return redirect()->back();
    }

    public function editModerator($userId)
    {
        return Inertia::render('Superadmin/Moderator/Edit', [
            'moderators'    =>  Moderator::where('user_id', $userId)->first()
        ]);
    }

    public function updateModerators(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'middle_name'   =>  'required',
            'last_name'     =>  'required',
        ]);

        Moderator::where('user_id', $request->user_id)->update([
            'first_name'    =>  $request->first_name,
            'middle_name'   =>  $request->middle_name,
            'last_name'     =>  $request->last_name
        ]);

        event(new UserLogCreated([
            'user_id'   =>  $request->user()->id,
            'action'    =>  User::find($request->user_id)->email . ' details has been updated.'
        ]));

        return redirect()->back();
    }

    public function deleteModerator(Request $request, $userId)
    {
        $user = User::find($userId);

        Moderator::where('user_id', $userId)->delete();

        event(new UserLogCreated([
            'user_id'   =>  $request->user()->id,
            'action'    =>  'Account has been deleted.'
        ]));
        
        $user->delete();

        return redirect()->back();
    }

    public function showClients()
    {
        return Inertia::render('Moderator/Clients', [
            'clients'   =>  Client::orderBy('created_at', 'desc')
                ->with('user')
                ->with('userProgram')->get()
        ]);
    }

    public function showSelectedClient($id)
    {
        $client = Client::where('user_id', $id)->with('user')->first();
        return Inertia::render('Moderator/Client/SelectedClient', [
            'client'    =>  $client,
            'userPrograms' =>  UserProgram::where('user_id', $client->user_id)->with('program')->get()
        ]);
    }

    public function showSelectedProgram($id, $programId)
    {
        return Inertia::render('Moderator/Client/SelectedProgram', [
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
