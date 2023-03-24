<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\delivery_price;
class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delivery=delivery_price::all();
        return $delivery;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $delivery= new delivery_price();
        $delivery->governorate= $request->governorate;
        $delivery->price=$request->price;
        $delivery->time=$request->time;
        $delivery->created_at=now();
        $delivery->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $delivery=delivery_price::find($id);
        return $delivery;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $delivery=delivery_price::find($id)->update($request->all());   
        return $delivery;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delivery = delivery_price::find($id);
        $delivery->delete();
    }
}
