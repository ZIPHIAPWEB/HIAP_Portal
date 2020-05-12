<?php

namespace App\Http\Controllers;

use App\Mail\SendInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function sendInquiry(Request $request)
    {
        $request->validate([
            'fullName'      =>  'required',
            'mobileNumber'  =>  'required',
            'email'         =>  'required',
            'message'       =>  'required'
        ]);

        Mail::to('info@hospitalityinstituteofamerica.com.ph')->send(new SendInquiry($request->all()));

        return redirect()->back();
    }
}
