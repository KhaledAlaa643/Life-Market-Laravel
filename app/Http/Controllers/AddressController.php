<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\AddressCreatedNotification;

class AddressController extends Controller
{
    public function getAddress(Request $request)
    {
        $user_id = Auth::user()->id;

        $address= DB::table('address')->where('user_id', $user_id)->get();
        if((count($address))==0){
            return response()->json(['error'=>'no address added for this user']);
        }else{
            return $address;
        }

    }
    
    public function createAddress(Request $request){
        $user_id =Auth::user()->id;
       
        $request->validate([
            'street'=>'required | string',
            'city'=>'required | string',
            'governorate'=>'required | string',
            'zip_code'=>'required | int',
        ]);
       $address= Address::create([
            'user_id'=>$user_id,
            'street'=>$request->street,
            'city'=>$request->city,
            'governorate'=>$request->governorate,
            'zip_code'=>$request->zip_code,
            'created_at' => now()
        ]);
       
        // Create a new notification model instance
   // Create a new notification model instance
$notification = new Notification([
    'user_id' => $user_id,
    'data' => 'Address created successfully.',
    'notifiable_id' => $address->id, // set the notifiable_id to the ID of the address
    'notifiable_type' => 'App\Models\Address', // set the notifiable_type to the class name of the address model
]);

// Save the notification to the database
$notification->save();
   
return response()->json([
    'address' => $address,
    'notification' => $notification
]);
    }
    public function updateAddress(Request $request)
    {
        $user_id= Auth::user()->id;

         DB::table('address')->where('user_id', $user_id)->update([

             'user_id'=>$user_id,
            'street'=>$request->street,
            'city'=>$request->city,
            'governorate'=>$request->governorate,
            'zip_code'=>$request->zip_code,
            'updated_at' => now()
        ]);

       $UpdatedAddress =DB::table('address')->where('user_id', $user_id)->first();
       $notification = new Notification([
        'user_id' => $user_id,
        'data' => 'Great! your Address Updated successfully.',

        'notifiable_type' => 'App\Models\Address', // set the notifiable_type to the class name of the address model
    ]);
    
    // Save the notification to the database
    $notification->save();
       
   
       
        return response()->json([
            'updated address' => $UpdatedAddress,
            'notification' => $notification
    ]);
    }
   
}
