<?php

namespace App\Http\Controllers;

use App\Client;
use App\Events\UserLogCreated;
use App\Http\Requests\ModeratorCreateRequest;
use App\Initial;
use App\Moderator;
use App\OnlineProgram;
use App\Payment;
use App\Program;
use App\School;
use App\Services\ModeratorService;
use App\User;
use App\UserProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ModeratorController extends Controller
{
    private $moderatorService;

    public function __construct(ModeratorService $moderatorService)
    {
        $this->moderatorService = $moderatorService;    
    }

    public function showDashboard()
    {
        return Inertia::render('Moderator/Dashboard', [
            'schools'       =>  School::orderBy('name', 'asc')
                                    ->with(['clients' => function($query) {
                                        return $query->withCount(['get_new_learners', 'get_confirmed_learners', 'get_complete_learners', 'userProgram']);
                                    }])
                                    ->get()

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
        $user = $this->moderatorService->registerNewModerator($request);

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
                ->with('school')
                ->with('onlineProgram')
                ->with(['userProgram' => function($query) {
                    return $query->with('program');
                }])
                ->paginate(15),
            'schools'   =>  School::orderBy('name')->get()
        ]);
    }

    public function showSelectedClient($id)
    {
        $client = Client::where('user_id', $id)->with('user')->with('school')->first();
        return Inertia::render('Moderator/Client/SelectedClient', [
            'client'            =>  $client,
            'initials'              =>  Initial::orderBy('id', 'asc')
                ->with(['clientInitial' => function ($query) use ($client) {
                    return $query->where('user_id', $client->user_id);
                }])
                ->get()
                ->map(function ($initial) {
                    return [
                        'id'                =>  $initial->id,
                        'name'              =>  $initial->name,
                        'client_initial'    =>  [
                            'id'        =>  $initial->clientInitial->id,
                            'initial_id'=>  $initial->clientInitial->initial_id,
                            'user_id'   =>  $initial->clientInitial->user_id,
                            'status'    =>  $initial->clientInitial->status,
                            'file_path' =>  Storage::url($initial->clientInitial->file_path)
                        ]
                    ];
                }),
            'schools'           =>  School::orderBy('name', 'asc')->get(),
            'online_programs'   =>  OnlineProgram::orderBy('name', 'asc')->get(),
            'courses'           =>  Program::where('isActive', 1)->orderBy('name', 'asc')->get(),
            'payments'  =>  Payment::where('user_id', $id)->get()->map(function($payment) {
                return [
                    'id'            =>  $payment->id,
                    'user_id'       =>  $payment->user_id,
                    'purpose'       =>  $payment->purpose,
                    'paid_from'     =>  $payment->paid_from,
                    'mop'           =>  $payment->mop,
                    'date_paid'     =>  $payment->date_paid,
                    'amount_paid'   =>  $payment->amount_paid,
                    'isVerified'    =>  $payment->isVerified,
                    'path'          =>  ($payment->path) ? '/slips/' . $payment->path : '',
                    'created_at'    =>  $payment->created_at->toDayDateTimeString(),
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
                ->map(function($userProgram) {
                    return [
                        'id'                    =>  $userProgram->id,
                        'user_id'               =>  $userProgram->user_id,
                        'course_id'             =>  $userProgram->course_id,
                        'program_id'            =>  $userProgram->program_id,
                        'hours_needed'          =>  $userProgram->hours_needed,
                        'application_status'    =>  $userProgram->application_status,
                        'start_date'            =>  $userProgram->start_date,
                        'end_date'              =>  $userProgram->end_date,
                        'program'               =>  $userProgram->program,
                        'course'                =>  $userProgram->course,
                        'created_at'            =>  $userProgram->created_at->diffForHumans()
                    ];
                })
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

    public function searchStudentByLastName(Request $request)
    {
        return Client::where('last_name', 'like', '%'. $request->last_name .'%')
            ->orWhere('first_name', 'like' ,'%'. $request->last_name .'%')
            ->with('user')
            ->with('payments')
            ->with('school')
            ->with(['userProgram' => function($query) {
                return $query->with('program');
            }])
            ->get();
    }
}
