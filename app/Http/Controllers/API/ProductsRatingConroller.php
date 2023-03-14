<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\ProductsRating;
class ProductsRatingConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rat=ProductsRating::all("star");
        return $rat;
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
        $x = ProductsRating::where('prd_id',$id)->get("star");
        $sum=0;
        $i=0;
        foreach($x as $y ){
           
            $sum+=$y["star"];
            $i++;
        }
        if ($i!=0)
        {
            return $sum/$i;

        }
        else
        {
            return "no reviews";
        }
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
