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
            'full_name'     =>  'required',
            'mobile_number' =>  'required',
            'email'         =>  'required|email',
            'message'       =>  'required'
        ]);

        Mail::to('info@hospitalityinstituteofamerica.com.ph')->send(new SendInquiry($request->only('full_name', 'mobile_number', 'email', 'message')));

        return redirect()->back();
    }
}
