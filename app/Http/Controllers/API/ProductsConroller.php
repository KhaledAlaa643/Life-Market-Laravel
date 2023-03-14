<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsRating;

class ProductsConroller extends Controller
{
    public function updateproduct(string $id)  //update product quantity& selling count by prod id 
    {
        $product=Products::find($id);
        
        $product["selling_count"]+=1;
        $product["quantity"]-=1;
        $product->save();
        return $product;
        
    }


    public function getrate (string $id)
    {
        $stars= ProductsRating::where('prd_id',$id)->get("star");
        $sum=0;
        $i=0;
        $rate=0;
        foreach($stars as $y ){
           
            $sum+=$y["star"];
            $i++;
        }
        if ($i!=0)
        {
            $rate=$sum/$i;

        }
        $product= Products::find($id);
        if ($product)
        {
        $product["prd_rating"]=$rate;
        $product->save();
        return $product;
        }
        else
        {
           return [];
        }
         


        

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
