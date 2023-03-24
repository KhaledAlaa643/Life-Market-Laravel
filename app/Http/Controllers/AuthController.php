<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\httpResponses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use httpResponses;

    public function login(Request $request)
    {if(  Auth::attempt($request->only('email','password'))  )
        {
                  $user=User::where('email',$request->email)->first();
          $token= Auth::user()->createToken('nene');
          return ['token' => $token->plainTextToken, 'user'=>$user
          ];
        }else{
        return [
          "message"=>"wrong email  or password"
        ];
    }

    }
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['required'],
            'type' => [
                'required',

            ],
            'email' => [
                'required',
                'string',
                'unique:users',

            ],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers(), Password::defaults()],

        ]);



        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if($user->wasRecentlyCreated){
            $token= $user->createToken('api token of '. $user->first_name);
              return ['token' => $token->plainTextToken];
             }



    }
    public function logout(Request $request)
    {

        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return response()->json('Successfully logged out');
    }


}
