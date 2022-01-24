<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitialStoreRequest;
use App\Http\Requests\InitialUpdateRequest;
use App\Initial;
use App\Program;
use App\Services\InitialRequirementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class InitialRequirementController extends Controller
{
    public function showInitialRequirements($programId)
    {
        return Inertia::render('Superadmin/ProgramInitial', [
            'program'   =>  Program::find($programId),
            'initials'  =>  Initial::where('program_id', $programId)
                ->get()
                ->map(function($initial) {
                    return [
                        'id'            =>  $initial->id,
                        'name'          =>  $initial->name,
                        'description'   =>  $initial->description,
                        'type'          =>  $initial->type,
                        'file_path'     =>  ($initial->file_path <> null || $initial->file_path <> '') ? url(Storage::url($initial->file_path)) : '',
                        'created_at'    =>  $initial->created_at->toDateTimeString(),
                    ];
                })
        ]);
    }

    public function storeInitialRequirement(InitialStoreRequest $request, $programId)
    {   
        $request->validated();

        (new InitialRequirementService)->addRequirement($request->all(), $programId);

        return redirect()->back();
    }

    public function updateInitialRequirement(InitialUpdateRequest $request)
    {
        (new initialRequirementService())->updateRequirement($request);

        return redirect()->back()->with(['message' => 'Initial Requirement Updated!']);
    }

    public function deleteInitialRequirement($initialId)
    {
        (new initialRequirementService())->removeRequirement($initialId);

        return redirect()->back();
    }
    
    public function getInitial()
    {
        $initials = Initial::orderBy('id', 'asc')
            ->where('program_id', request()->user()->program_id)
            ->with(['clientInitial' => function ($query) {
                return $query->where('user_id', request()->user()->id);
            }])
            ->get()
            ->map(function ($query) {
                return [
                    'id'            =>  $query->id,
                    'program_id'    =>  $query->program_id,
                    'name'          =>  $query->name,
                    'description'   =>  $query->description,
                    'file_path'     =>  $query->file_path,
                    'client_initial'=>  [
                        'id'        =>  $query->clientInitial->id,
                        'initial_id'=>  $query->clientInitial->initial_id,
                        'user_id'   =>  $query->clientInitial->user_id,
                        'status'    =>  $query->clientInitial->status,
                        'file_path' =>  Storage::url($query->clientInitial->file_path)
                    ]
                ];
            });

        return response()->json($initials, 200);
    }
    
    public function getAllInitialRequirements($programId)
    {
        return Initial::where('program_id', $programId)->get();
    }
}
