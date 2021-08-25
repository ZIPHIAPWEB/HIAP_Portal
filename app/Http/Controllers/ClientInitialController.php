<?php

namespace App\Http\Controllers;

use App\ClientInitial;
use App\Http\Requests\ClientInitialStoreRequest;
use App\Services\InitialClientRequirementService;
use App\Services\InitialRequirementService;
use Illuminate\Http\Request;

class ClientInitialController extends Controller
{
    public function getClientInitialRequirements (Request $request)
    {
        return ClientInitial::where('user_id', $request->user()->id)
            ->with('initial', function ($query) {
                $query->where('program_id', 2);
            })
            ->get();
    }

    public function storeClientInitialRequirement(ClientInitialStoreRequest $request)
    {
        (new InitialClientRequirementService())->uploadRequirement($request->validated());

        return redirect()->back();
    }   

    public function deleteClientInitialRequirement($id)
    {
        (new InitialClientRequirementService())->removeUploadedRequirement($id);

        return redirect()->back();
    }
}
