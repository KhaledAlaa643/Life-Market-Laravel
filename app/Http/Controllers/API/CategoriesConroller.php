<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Products;

class CategoriesConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getproducts (string $id)   //get products by cat id
    {

        $arr[]=[];
        $i=0;
        $subcat_ids=SubCategories::where('cat_id',$id)->get("id");
        if (count($subcat_ids)!=0)
        {
         $product=Products::all();

         foreach ($subcat_ids as $ids )
         {
            foreach ($product as $prd)
            {
                if ($prd["sub_cat_id"]==$ids["id"] && $prd->quantity > 0)
                {
                    $arr[$i]=$prd;
                    $i++;
                }
            }
           
         }
        }
        return $arr;   
    }

    public function index()
    {
        $categories=Categories::all();
        return $categories;
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
        $sub_cat=SubCategories::where('cat_id',$id)->get();
        return $sub_cat;
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
