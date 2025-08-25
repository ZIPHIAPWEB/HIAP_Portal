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
            'fb_link'           =>  'required',
            'alternate_email'   =>  'required',
            'affiliation'       =>  'required',
            'date_of_birth'     =>  'required',

            'school'    =>  'required_if:affiliation,student',
            'school_year'   =>  'required_if:affiliation,student',
            'course'        =>  'required_if:affiliation,student',
            'section'       =>  'required_if:affiliation,student',
            'expected_graduation'   =>  'required_if:affiliation,student',

            'industry_id' =>  'required_if:affiliation,!=,employee',
            'company'   =>  'required_if:affiliation,!=,employee'
        ]);

        return back();
    }
}
