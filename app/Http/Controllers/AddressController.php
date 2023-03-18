<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return $address;
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

        return response()->json(['updated address' => $UpdatedAddress]);
    }
}
