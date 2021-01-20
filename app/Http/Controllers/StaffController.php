<?php

namespace App\Http\Controllers;

use App\Client;
use App\School;
use App\Services\StaffService;
use App\Staff;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StaffController extends Controller
{
    private $staff;

    public function __construct(StaffService $staffService)
    {
        $this->staff = $staffService;    
    }

    public function showRegistration()
    {
        return Inertia::render('Auth/StaffRegistration', [
            'schools' => School::orderBy('name', 'desc')->get()
        ]);
    }

    public function showDashboard(Request $request)
    {
        $user = Staff::where('user_id', $request->user()->id)
            ->with('school')
            ->first();

        return Inertia::render('Staff/Dashboard', [
            'user'      =>  $user,
            'students'  =>  Client::where('school', $user->school)
                ->with(['userProgram' => function ($query) {
                    return $query->with('course', 'program');
                }])
                ->paginate(8)
        ]);
    }

    public function register(Request $request)
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

        $this->staff->add($request);

        return redirect()->route('s.dashboard');
    }

    public function activateStaff($userId)
    {
        $this->staff->setActive($userId);

        return redirect()->back();
    }

    public function removeStaff($data)
    {
        $this->staff->remove($data);

        return redirect()->back();
    }
}
