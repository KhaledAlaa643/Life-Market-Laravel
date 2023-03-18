<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\DB;



class CartConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        $record =new Cart();
        $record->quantity=$request->quantity;
        $record->price=$request->price;
        $record->prd_id=$request->prd_id;
        $record->user_id=$id;
        $record->created_at=now();
        $record->save();
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
