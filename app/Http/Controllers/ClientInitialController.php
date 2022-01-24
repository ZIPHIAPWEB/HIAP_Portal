<?php

namespace App\Http\Controllers;

use App\ClientInitial;
use App\Http\Requests\ClientInitialStoreRequest;
use App\Initial;
use App\Services\InitialClientRequirementService;
use App\Services\InitialRequirementService;
use Illuminate\Http\Request;

class ClientInitialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');   
    }

    public function getClientInitialRequirements (Request $request)
    {
        // return ClientInitial::where('user_id', $request->user()->id)
        //     ->with('initial', function ($query) {
        //         $query->where('program_id', 2);
        //     })
        //     ->get();

        return Initial::where('program_id', $request->user()->program_id)
            ->with('clientInitial', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->get();
    }

    public function storeClientInitialRequirement(ClientInitialStoreRequest $request)
    {
        $request->validated();

        (new InitialClientRequirementService())->uploadRequirement($request);

        return redirect()->back();
    }   

    public function deleteClientInitialRequirement($id)
    {
        (new InitialClientRequirementService())->removeUploadedRequirement($id);
    }
}
