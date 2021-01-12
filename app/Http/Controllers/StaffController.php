<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StaffController extends Controller
{
    public function showRegistration()
    {
        return Inertia::render('Auth/StaffRegistration');
    }

    public function registerStaff(Request $request)
    {
        $request->validate([
            'email'                     =>  'required',
            'password'                  =>  'required',
            'password_confirmation'     =>  'required',
            'name'                      =>  'required',
            'position'                  =>  'required',
            'school'                    =>  'required',
            'contact_no'                =>  'required'
        ]);

        
    }
}
