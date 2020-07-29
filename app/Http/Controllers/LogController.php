<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LogController extends Controller
{
    public function showLogs()
    {
        return Inertia::render('Superadmin/Logs', [
            'logs'  =>  Log::orderBy('created_at', 'desc')->with('user')->paginate(20)
        ]);
    }

    public function deleteLog($logId)
    {
        Log::where('id', $logId)->delete();

        return redirect()->back();
    }
}
