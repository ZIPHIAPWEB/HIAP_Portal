<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\InitialStoreRequest;
use App\Http\Requests\InitialUpdateRequest;
use App\Initial;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;

class InitialController extends Controller
{
    public function showInitialRequirements($programId, Program $program, Initial $initial)
    {
        return Inertia::render('Superadmin/ProgramInitial', [
            'program'   => $program->find($programId),
            'initials'  => $initial->where('program_id', $programId)->get()
        ]);
    }

    public function storeInitialRequirement(InitialStoreRequest $request, $programId)
    {
        if ($request->hasFile('file')) {
            $filename = Str::snake($request->name) . '-' . time() . '.' . $request->file->extension();
            $request->file->move(public_path('initials'), $filename);
        }

        Initial::create([
            'program_id'    =>  $programId,
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'file_path'     =>  $request->hasFile('file') ? $filename : ''
        ]);

        return redirect()->back();
    }

    public function updateInitialRequirement(InitialUpdateRequest $request)
    {
        if ($request->hasFile('file')) {
            $filename = Str::snake($request->name) . '-' . time() . '.' . $request->file->extension();
            $request->file->move(public_path('initials'), $filename);
        }

        Initial::where('id', $request->id)->update([
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'file_path'     =>  $request->hasFile('file') ? $filename: ''
        ]);

        return redirect()->back()->with(['message' => 'Initial Requirement Updated!']);
    }

    public function deleteInitialRequirement($initialId)
    {
        $initial = Initial::where('id', $initialId);

        if(File::exists('initials/' . $initial->first()->file_path)) {
            File::delete('initials/' . $initial->first()->file_path);
        }

        $initial->delete();

        return redirect()->back();
    }

    public function getAllInitialRequirements($programId)
    {
        return Initial::where('program_id', $programId)->get();
    }

    public function getInitialRequirementsForClient(Request $request)
    {
        return Initial::where('program_id', Client::where('user_id', $request->user()->id)->first()->program_id)
            ->with('clientInitial')
            ->get()
            ->map(function ($initials) use ($request) {
                return [
                    'id'    =>  $initials->id,
                    'name'  =>  $initials->name,
                    'file_path' =>  $initials->file_path,
                    'client_initial'    =>  $initials->clientInitial->where('initial_id', $initials->id)->where('user_id', $request->user()->id)->first()
                ];
            });
    }
}
