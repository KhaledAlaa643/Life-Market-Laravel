<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsRating;

class ProductsConroller extends Controller
{
    //update product quantity& selling count by prod id 
    public function updateproduct(string $id)  
    {
        $product=Products::find($id);
        if ($product)
        {
            $product["selling_count"]+=1;
            $product["quantity"]-=1;
            $product->save();
            return $product;
        }
        else
        {
            return [];
        }
    }

//update rate of product based on product id from prd rate table
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

//get top rating products
    public function top_rating_products () 
    {   
        $all_products[]=[];
        $i=0;
        $products =Products::all();
        foreach ($products as $prd)
        {
            $all_products[$i]=$prd;
             $i++;
        }

          usort($all_products, function($a, $b)
             {
            return $b->prd_rating - $a->prd_rating;
           });

             return $all_products;
       
    }
//get top selling products
    public function top_selling_products ()
    {
        $all_products[]=[];
        $i=0;
        $products =Products::all();
        foreach ($products as $prd)
        {
            $all_products[$i]=$prd;
             $i++;
        }

          usort($all_products, function($a, $b)
             {
            return $b->selling_count - $a->selling_count;
           });

             return $all_products;

    }


    //get products count
    public function getproductscount()
    {
        $products=Products::all();
        return count($products);
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
