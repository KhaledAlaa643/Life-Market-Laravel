<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer=DB::table('users')->where('type','=','user')->get();
        return $customer;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    $request->validate([
        'first_name' => ['required', 'string', 'max:100'],
        'last_name' => ['required', 'string', 'max:100'],
        'phone' => ['required'],
        'type' => [ 'required',],
        'email' => [
            'required',
            'string',
            'unique:users',],
        'password' => [
            'required',
             'confirmed',
              Password::min(8)->letters()->numbers(),
              Password::defaults()
            ],
    ]); 
  
    $customer= new User();
    $customer->first_name= $request->first_name;
    $customer->last_name=$request->last_name;
    $customer->phone=$request->phone;
    $customer->email=$request->email;
    $customer->password=$request->password;
    $customer->type=$request->type;
    $customer->created_at=now();
    $customer->save();
   
    if($customer->wasRecentlyCreated){
        $token= $customer->createToken('api token of '. $customer->first_name);
          return ['token' => $token->plainTextToken];
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer=DB::table('users')->where('type','=','user')->find($id);

        return $customer;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer= User::find($id)->update($request->all());
        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted =User::where('type','=', 'user')->find($id);
        $deleted->delete();
    }
}
