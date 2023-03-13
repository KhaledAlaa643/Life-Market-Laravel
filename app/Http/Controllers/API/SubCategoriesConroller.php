<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategories;
use App\Models\Products;


class SubCategoriesConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $sub_cat=SubCategories::all();
        return $sub_cat;
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
        $product=Products::where('sub_cat_id',$id)->get();
        return $product;
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
