<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressModel;
use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class profile extends Controller
{




    public function userData()
    {
        return Auth::user()->all();
    }
    public function updateUserData(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,

            'updated_at' => now()
        ]);
        return response()->json(['user' =>$user]);
    }

}
