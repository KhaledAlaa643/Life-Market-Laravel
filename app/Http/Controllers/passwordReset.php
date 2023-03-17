<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class passwordReset extends Controller
{

    public function sendEmail(Request $request){

if (!$this->validateEmail($request->email)){
return $this->failedResponse();
}else {
   $this->send($request->email);
return response()->json(['nene'=>$request->email]);

}
         ;
    }
    public function validateEmail($sentEmail){
      return !!  User::where('email',$sentEmail) -> first();
    }

    public function failedResponse(){
        return response()->json([
            'error'=>'email not found'
        ]);
    }
    public function succesfullResponse(){
        return response()->json([
            'email'=>'email  found'
        ]);
    }
    public function send($userEmail){
        Mail::to($userEmail)->send(new passwordReset());

    }



}
