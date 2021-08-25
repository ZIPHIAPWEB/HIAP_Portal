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
                        'file_path'     =>  ($initial->file_path <> null || $initial->file_path <> '') ? url(Storage::url($initial->file_path)) : '',
                        'created_at'    =>  $initial->created_at->toDateTimeString(),
                    ];
                })
        ]);
    }

    public function storeInitialRequirement(InitialStoreRequest $request, $programId)
    {   
        (new InitialRequirementService)->addRequirement($request->validated(), $programId);

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
            ->with(['clientInitial' => function ($query) {
                return $query->where('user_id', request()->user()->id);
            }])
            ->get()
            ;

        return response()->json($initials, 200);
    }
    
    public function getAllInitialRequirements($programId)
    {
        return Initial::where('program_id', $programId)->get();
    }
}
