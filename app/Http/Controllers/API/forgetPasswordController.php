<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Notifications\resetPasswordNotification;
use App\Http\Requests\forgetpasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class forgetPasswordController extends Controller
{
    public function forgetPassword(forgetpasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $token = Password::createToken($user);

        $user->notify(new resetPasswordNotification($token));

        $success['success'] = true;

        return response()->json($success, 200);
    }
}
