<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProuductsDiscount;

class ProductsDiscountConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $x =ProuductsDiscount::all();
        return $x;
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
        $discount = ProuductsDiscount::where('prd_id',$id)->get("discount");
       
        return $discount[0]["discount"];
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
