<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function showLessonEntry($programId)
    {
        return Inertia::render('Superadmin/LessonEntry', [
            'programId' =>  $programId,
            'lessons'   =>  Lesson::where('program_id', $programId)->get()
        ]);
    }

    public function storeLesson(Request $request)
    {
        $request->validate([
            'title'         =>  'required',
            'description'   =>  'required'
        ]);

        Lesson::create([
            'program_id'    =>  $request->program_id,
            'title'         =>  $request->title,
            'description'   =>  $request->description
        ]);

        return redirect()->back();
    }

    public function updateLesson(Request $request, $lessonId)
    {
        Lesson::where('id', $lessonId)->update([
            'title'         =>  $request->title,
            'description'   =>  $request->description
        ]);

        return redirect()->back();
    }

    public function deleteLesson($lessonId)
    {
        Lesson::where('id', $lessonId)->delete();

        return redirect()->back();
    }
}
