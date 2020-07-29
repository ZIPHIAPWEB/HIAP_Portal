<?php

namespace App\Http\Controllers;

use App\Client;
use App\Grade;
use App\Lesson;
use App\Program;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function showTeacherDashboard()
    {
        return Inertia::render('Teacher/Dashboard', [
            'programs'  =>  Program::orderBy('id', 'asc')->with('clients')->get(),
            'lessons'   =>  Lesson::where('program_id', 7)->get()->chunk(10)->sortBy('id'),
            'students'  =>  Client::where('program_id', 7)->with('lesson')->get()
                ->map(function($query) {
                    return [
                        'user_id'   =>  $query->user_id,
                        'full_name' =>  $query->first_name . ' ' . $query->last_name,
                        'lessons'    =>  $query->lesson->map(function($lesson) use ($query) {
                            return [
                                'lesson'    =>  $lesson->title,
                                'grade'     =>  $lesson->grade ? $lesson->grade->where('user_id', $query->user_id)->where('lesson_id', $lesson->id)->first() : null
                            ];
                        })
                        ->chunk(10)
                    ];
                })
        ]);
    }

    public function showGradebook($programId)
    {
        $export = collect(['Full name' =>  'full_name']);
        $lessons = Lesson::where('program_id', $programId)->orderBy('id', 'ASC')->get();
        foreach ($lessons as $key => $lesson) {
            $export->prepend('lessons.'. $lesson->title . '.grade', $lesson->title);
        }

        return Inertia::render('Teacher/Gradebook', [
            'program'   =>  Program::where('id', $programId)->first(),
            'exp'  => [
                'fields' => $export->reverse(),
                'data'   => Client::where('program_id', $programId)->with('lesson')->get()
                    ->map(function($query) {
                        return [
                            'full_name' =>  $query->first_name . ' ' . $query->last_name,
                            'lessons'   =>  $query->lesson->flatMap(function($lesson) use ($query) {
                                return [$lesson->title => $lesson->grade ? $lesson->grade->where('user_id', $query->user_id)->where('lesson_id', $lesson->id)->first() : null];
                            })
                        ];
                    })
            ],
            'lessons'   =>  Lesson::where('program_id', $programId)->get()->chunk(10)->sortBy('id'),
            'students'  =>  Client::where('program_id', $programId)->with('lesson')->get()
                ->map(function($query) {
                    return [
                        'user_id'   =>  $query->user_id,
                        'full_name' =>  $query->first_name . ' ' . $query->last_name,
                        'lessons'    =>  $query->lesson->map(function($lesson) use ($query) {
                            return [
                                'lesson'    =>  $lesson->title,
                                'grade'     =>  $lesson->grade ? $lesson->grade->where('user_id', $query->user_id)->where('lesson_id', $lesson->id)->first() : null
                            ];
                        })
                        ->chunk(10)
                    ];
                })
        ]);
    }

    public function showStudents(Request $request)
    {
        return Inertia::render('Teacher/Students', [
            'programs'  =>  Program::orderBy('id', 'asc')->get(),
            'students'  =>  Client::orderBy('created_at', 'desc')->with('user')->with('program')->paginate(12)
        ]);
    }

    public function showStudentProfile($userId)
    {
        $student = Client::where('user_id', $userId)->with('user')->with('program')->first();
        return Inertia::render('Teacher/StudentSingle', [
            'student'    =>  $student,
            'grades'     =>  Lesson::where('program_id', $student->program_id)
                ->with(['grade' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }])
                ->get()
        ]);
    }

    public function showTeacherEntry()
    {
        return Inertia::render('Superadmin/TeachersEntry', [
            'teachers'  =>  Teacher::orderBy('first_name', 'asc')->with('user')->get()
        ]);
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'middle_name'   =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'required'
        ]);

        $user = User::create([
            'email'     =>  $request->email,
            'role'      =>  'teacher',
            'password'  =>  Hash::make(strtolower(str_replace(' ', '', $request->last_name))),
            'isFilled'  =>  true
        ]);

        Teacher::create([
            'user_id'       =>  $user->id,
            'first_name'    =>  $request->first_name,
            'middle_name'   =>  $request->middle_name,
            'last_name'     =>  $request->last_name
        ]);

        return redirect()->back();
    }

    public function updateTeacher(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'middle_name'   =>  'required',
            'last_name'     =>  'required',
        ]);

        Teacher::where('user_id', $request->user_id)->update([
            'first_name'    =>  $request->first_name,
            'middle_name'   =>  $request->middle_name,
            'last_name'     =>  $request->last_name
        ]);

        return redirect()->back();
    }

    public function deleteTeacher($userId)
    {
        User::find($userId)->delete();
        Teacher::where('user_id', $userId)->delete();

        return redirect()->back();
    }
}
