<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserConroller extends Controller
{


    //get users count
    public function getuserscount()
    {
        $users=User::where('type', 'user')->get();
        return count($users);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::where('type', 'user')->get(["id","first_name","created_at"]);

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
