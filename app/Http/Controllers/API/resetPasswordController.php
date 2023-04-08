<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use App\Models\User;
use App\Http\Requests\resetpasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Log;

class resetPasswordController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function resetPassword(Request $request)
    {
        // Validate OTP
        $otp = new Otp;
        $result = $this->otp->validate($request->email, $request->otp);

        if (!$result ) {
            return response()->json(['valid_code' => false], 200);
        }
    
        // Store OTP in the database
        $otpData = [
            'identifier' => $request->email,
            'token' => $request->otp,
            'validity' => now()->addMinutes(10), // Set validity for 10 minutes from now
        ];
        Otp::create($otpData);
        
        // Create token and send email
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('PasswordReset')->plainTextToken;
        $user->remember_token = $token;
        $user->save();
        
        // Mail::to($user->email)->send(new ResetPasswordMail($token));
    
        $code['valid_code'] = true;
        return response()->json($code, 200);
    }
    
}    