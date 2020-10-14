<?php

namespace App\Http\Controllers;

use App\Initial;
use App\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    public function __construct()
    {
    }

    public function showProgramEntry()
    {
        return Inertia::render('Superadmin/ProgramEntry', [
            'programs'  =>  Program::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function storeProgramDetails(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'description'   =>  'required'
        ]);

        Program::create([
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return redirect()->back();
    }

    public function getAllPrograms()
    {
        return Program::where('isActive', 1)
                    ->orderBy('name', 'asc')
                    ->get();
    }

    public function updateProgramDetails(Request $request, $id)
    {
        $program = Program::where('id', $id);

        $program->update([
            'name'          =>  $request->input('name'),    
            'description'   =>  $request->input('description')
        ]);

        return redirect()->back();
    }

    public function deleteProgramDetails($id)
    {
        Program::where('id', $id)->delete();

        return redirect()->back();
    }
}
