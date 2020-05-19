<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function __construct()
    {
    }

    public function storeProgramDetails(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'description'   =>  'required'
        ]);

        return Program::create([
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);
    }

    public function getAllPrograms()
    {
        return Program::orderBy('name', 'asc')->get();
    }

    public function updateProgramDetails(Request $request, $id)
    {
        $program = Program::where('id', $id);

        $program->update([
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description')
        ]);

        return $program->first();
    }

    public function deleteProgramDetails($id)
    {
        Program::where('id', $id)->delete();

        return response()->json([
            'message'   =>  'Program Deleted'
        ]);
    }
}
