<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitialStoreRequest;
use App\Http\Requests\InitialUpdateRequest;
use App\Initial;
use App\Program;
use App\Services\InitialRequirementService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InitialController extends Controller
{
    private $initialRequirementService;

    public function __construct(InitialRequirementService $initialRequirementService)
    {
        $this->initialRequirementService = $initialRequirementService;    
    }

    public function showInitialRequirements($programId)
    {
        return Inertia::render('Superadmin/ProgramInitial', [
            'program'   => Program::find($programId),
            'initials'  => Initial::where('program_id', $programId)->get()
        ]);
    }

    public function storeInitialRequirement(InitialStoreRequest $request, $programId)
    {   
        $this->initialRequirementService->addRequirement($request, $programId);

        return redirect()->back();
    }

    public function updateInitialRequirement(InitialUpdateRequest $request)
    {
        $this->initialRequirementService->updateRequirement($request);

        return redirect()->back()->with(['message' => 'Initial Requirement Updated!']);
    }

    public function deleteInitialRequirement($initialId)
    {
        $this->initialRequirementService->removeRequirement($initialId);

        return redirect()->back();
    }
    
    public function getInitial()
    {
        return dd([]);
    }
    
    public function getAllInitialRequirements($programId)
    {
        return Initial::where('program_id', $programId)->get();
    }
}
