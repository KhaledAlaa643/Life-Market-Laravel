<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferProducts;
use App\Models\Products;
use App\Models\Offers;

class OfferProductsConroller extends Controller
{
    public function add_offer_products(string $off_id ,Request $request)
    {
        if ($request->prd_id!="")
        {
        $new_offer=new OfferProducts ();
        $new_offer->prd_id=$request->prd_id;        //save new product offer
        $new_offer->offer_id=$off_id;

        $new_offer->save();
        }
        /////////////////////////////////////////////////////////////////////
        $arr[]=[];
        $i=0;
        //get ids of offer products 
        $offer_products_id=OfferProducts::where('offer_id',$off_id)->get("prd_id");

        if (count($offer_products_id)!=0)
        {
           foreach($offer_products_id as $prd)                             //get all products that have the same product offer
           {
            $product=Products::where('id',$prd["prd_id"])->get();
            if (count ($product)!=0)
                 { $arr[$i]= $product[0];
                    $i++;
                 }

           }
        }
        ////////////////////////////////////////////////////////////////////////////
            $off_discount=Offers::where('id',$off_id)->get("discont_percent");
           
            foreach ($arr as $pro)
            {
            $pro["price_before_discount"]=$pro["price"];

            $pro["price"]=$pro["price_before_discount"]-( $pro["price_before_discount"] *$off_discount[0]->discont_percent/100);
            
            }
            
            foreach ($arr as $pro)
            {
                $x=array_unique($arr);

            }
            foreach ($x as $pro)
            {
                $pro->save();

         }


    }
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

    //get products where offer id = prd_id 
    public function show(string $id)  
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
