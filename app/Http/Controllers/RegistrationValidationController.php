<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationValidationController extends Controller
{
    public function basicDetailsValidation(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'address'       =>  'required',
            'contact_number'=>  'required',
            'school_year'   =>  'required',
            'course'        =>  'required',
            'section'       =>  'required',
            'expected_graduation'   =>  'required',
            'fb_link'           =>  'required',
            'alternate_email'   =>  'required'
        ]);

        return back();
    }
}
