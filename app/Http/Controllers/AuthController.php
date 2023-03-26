<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\httpResponses;
use App\Models\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use httpResponses;

    // public function login(Request $request)
    // {if(  Auth::attempt($request->only('email','password'))  )
    //     {
    //               $user=User::where('email',$request->email)->first();
    //       $token= Auth::user()->createToken('nene');
    //       return ['token' => $token->plainTextToken, 'user'=>$user
          
    //       ];
    //     }
       
    //     return [
    //       "message"=>"wrong email  or password"
    //     ];

    // }
    public function login(Request $request)
{
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = User::where('email', $request->email)->first();
        $token = Auth::user()->createToken('nene');
        
        // Create a notification
        $notification = new Notification([
            'user_id' => $user->id,
            'data' => 'WELCOME!You have successfully logged in.',
            'notifiable_id' => $user->id,
            'notifiable_type' => 'App\Models\User',
        ]);

        // Save the notification to the database
        $notification->save();
        
        return [
            'token' => $token->plainTextToken,
            'user' => $user,
            'notification' => $notification

        ];
    }

    return [
        'message' => 'Wrong email or password',
    ];
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

    public function getNotifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications()->orderBy('created_at', 'desc')->get();
        
        // mark all notifications as read
        $request->user()->unreadNotifications->markAsRead();
    
        return response()->json(['notifications' => $notifications]);
    }
    
    
    
}
