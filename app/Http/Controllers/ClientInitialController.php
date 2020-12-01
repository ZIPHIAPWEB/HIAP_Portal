<?php

namespace App\Http\Controllers;

use App\ClientInitial;
use App\Http\Requests\ClientInitialStoreRequest;
use App\Services\InitialClientRequirementService;
use App\Services\InitialRequirementService;
use Illuminate\Http\Request;

class ClientInitialController extends Controller
{
    private $initialRequirement;

    public function __construct(InitialClientRequirementService $initialRequirementService)
    {
        $this->initialRequirement = $initialRequirementService;
    }

    public function getClientInitialRequirements (Request $request, $programId)
    {
        return ClientInitial::where('user_id', $request->user()->id)
            ->with('initial', function ($query) use ($programId){
                $query->where('program_id',$programId);
            })
            ->get();
    }

    public function storeClientInitialRequirement(ClientInitialStoreRequest $request)
    {
        return $this->initialRequirement->uploadRequirement($request);
    }   

    public function deleteClientInitialRequirement($id)
    {
        $this->initialRequirement->removeUploadedRequirement($id);
    }
}
