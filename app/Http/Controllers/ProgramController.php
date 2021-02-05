<?php

namespace App\Http\Controllers;

use App\Course;
use App\OnlineProgram;
use App\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    public function showProgramEntry()
    {
        return Inertia::render('Superadmin/ProgramEntry', [
            'programs'  =>  Program::orderBy('created_at', 'desc')->with('onlineProgram')->get(),
            'courses'   =>  OnlineProgram::orderBy('created_at', 'asc')->get()
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
            'description'   =>  $request->input('description'),
            'course_id'     =>  $request->course,
            'isActive'      =>  true
        ]);

        return redirect()->back()
            ->with('message', 'Program Added');
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
            'description'   =>  $request->input('description'),
            'course_id'     =>  $request->course,
            'isActive'      =>  $request->isActive
        ]);

        return redirect()->back()
            ->with('Program Updated');
    }

    public function deleteProgramDetails($id)
    {
        Program::where('id', $id)->delete();

        return redirect()->back()
            ->with('message', 'Program deleted.');
    }

    public function activateProgram($id)
    {
        Program::where('id', $id)->update([
            'isActive'  =>  true
        ]);

        return redirect()->back()
            ->with('message', 'Program activated.');
    }

    public function deactivateProgram($id)
    {
        Program::where('id', $id)->update([
            'isActive'  =>  false
        ]);

        return redirect()->back()
            ->with('message', 'Program deactivated.');
    }
}
