<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsConroller extends Controller
{
    public function updateproduct(string $id)
    {
        $product=Products::find($id);
        
        $product["selling_count"]+=1;
        $product["quantity"]-=1;
        $product->save();
        // $product->update($product->all());
        return $product;
        
    }


    public function index()
    {
        $x=Products::all();
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
