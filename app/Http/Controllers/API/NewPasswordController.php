<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
           
            'email' => 'nullable|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $user = null;
    
       
         if (!empty($request->email)) {
            $user = User::where('email', $request->email)->first();
        }
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $user->password = Hash::make($request->password);

        $user->save();
    
        return response()->json([
            'reset_password' => true,
        ], 200);
    }
}

