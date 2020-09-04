<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function showSchoolEntry()
    {
        return Inertia::render('Superadmin/SchoolEntry', [
            'schools'   =>  School::orderBy('name')->get()
        ]);
    }

    public function storeSchool(Request $request)
    {
        School::create([
            'name'          =>  $request->name,
            'display_name'  => $request->display_name
        ]);

        return redirect()->back();
    }

    public function updateSchool(Request $request)
    {
        School::find($request->id)->update([
            'name'          =>  $request->name,
            'display_name'  =>  $request->display_name
        ]);

        return redirect()->back();
    }

    public function deleteSchool($id)
    {
        School::find($id)->delete();

        return redirect()->back();
    }
}
