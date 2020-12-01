<?php

namespace App\Http\Controllers;

use App\Services\UserProgramService;
use App\UserProgram;
use Illuminate\Http\Request;

class UserProgramController extends Controller
{
    private $userProgramService;

    public function __construct(UserProgramService $userProgramService)
    {
        $this->userProgramService = $userProgramService;
    }

    public function addNewProgram(Request $request)
    {
        if($this->userProgramService->saveUserProgram($request)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('Program already enrolled.');
        }
    }

    public function getUserPrograms(Request $request)
    {
        $user = UserProgram::where('user_id', $request->user()->id)->get();

        return $user;
    }

    public function setApplicationStatus(Request $request, $id)
    {
        UserProgram::where('user_id', $id)
            ->where('program_id', $request->program_id)
            ->update([
                'application_status'    =>  $request->application_status
            ]);

        return redirect()->back()->with([
            'message'   =>  'Application Status Updated.'
        ]);
    }

    public function deleteUserProgram($id)
    {
        UserProgram::where('id', $id)->delete();

        return redirect()->back()->with([
            'message'   =>  'Program deleted'
        ]);
    }
}
