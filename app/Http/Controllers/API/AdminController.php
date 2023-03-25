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
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $admin=DB::table('users')->where('type','=','admin')->get();
        return $admin;
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
  
       $admin= new User();
       $admin->first_name= $request->first_name;
       $admin->last_name=$request->last_name;
       $admin->phone=$request->phone;
       $admin->email=$request->email;
       $admin->password=$request->password;
       $admin->type='admin';
       $admin->created_at=now();
       $admin->save();
   
    if($admin->wasRecentlyCreated){
        $token= $admin->createToken('api token of '. $admin->first_name);
          return ['token' => $token->plainTextToken];
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin=DB::table('users')->where('type','=','admin')->find($id);

        return $admin;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->password == ''){
            $admin= User::find($id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        }
        else{
            $admin= User::find($id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }
        return $admin;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted =User::where('type','=', 'admin')->find($id);
       
        $deleted->delete();

        
    }
}
