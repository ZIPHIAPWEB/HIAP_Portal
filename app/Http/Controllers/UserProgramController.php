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
        $this->userProgramService->saveUserProgram($request);

        return redirect()->back();
    }

    public function getUserPrograms(Request $request)
    {
        $user = UserProgram::where('user_id', $request->user()->id)->get();

        return $user;
    }

    public function setApplicationStatus(Request $request, $id)
    {
        $this->userProgramService->updateStatus($request->status, $id);

        return redirect()->back()->with([
            'message'   =>  'Application Status Updated.'
        ]);
    }

    public function deleteUserProgram($id)
    {
        $this->userProgramService->removeProgram($id);

        return redirect()->back()->with([
            'message'   =>  'Program deleted'
        ]);
    }
}
