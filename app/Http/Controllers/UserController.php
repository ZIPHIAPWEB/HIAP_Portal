<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updateUserPassword(UpdatePasswordRequest $request)
    {
        $request->validated();

        $isCurrentPasswordCorrect = Hash::check($request->current, $request->user()->password);

        if ($isCurrentPasswordCorrect) {
            User::where('id', $request->user()->id)->update([
                'password'  => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'Password changed'
            ]);
        }

        return response()->json('Current password incorrect', 422);
    }
}
