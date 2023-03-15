<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferProducts;
use App\Models\Products;

class OfferProductsConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)  //get products where offer id = prd_id
    {   
        $arr[]=[];
        $i=0;
        //get ids of offer products 
        $offer_products_id=OfferProducts::where('offer_id',$id)->get("prd_id");

        if (count($offer_products_id)!=0)
        {
           foreach($offer_products_id as $prd)
           {
            $product=Products::where('id',$prd["prd_id"])->get();
            if (count ($product)!=0)
                 { $arr[$i]= $product[0];
                    $i++;
                 }

           }
        }
        
        return $arr;
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
