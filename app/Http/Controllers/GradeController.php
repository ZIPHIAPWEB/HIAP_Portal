<?php

namespace App\Http\Controllers;

use App\Client;
use App\Grade;
use App\Http\Requests\GradeStoreRequest;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function storeGrade(Grade $grade, GradeStoreRequest $request)
    {
        $grade->create([
            'program_id'=>  $request->program_id,
            'lesson_id' =>  $request->lesson_id,
            'user_id'   =>  $request->user_id,
            'title'     =>  $request->title,
            'grade'     =>  $request->grade
        ]);

        return redirect()->back();
    }

    public function getClientGrades(Lesson $lesson, Client $client, $programId)
    {
        $user = $client->where('user_id', Auth::user()->id)->first();

        return $lesson->where('program_id', $programId)->with(['grade' => function ($query) use ($user) {
            $query->where('user_id', $user->user_id);
        }])->get();
    }

    public function deleteGrade(Grade $grade, $gradeId)
    {
        $grade->where('id', $gradeId)->delete();

        return redirect()->back();
    }
}
