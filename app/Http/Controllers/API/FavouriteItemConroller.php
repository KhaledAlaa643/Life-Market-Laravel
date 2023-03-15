<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavouriteItem;
use App\Models\Products;

class FavouriteItemConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

   
     //get products (favourite) based on user_id
    public function show(string $id)
    {
        $arr[]=[];
        $i=0;
        $prd_ids=FavouriteItem::where('user_id',$id)->get("prd_id");
        if (count($prd_ids)!=0)
        {

         foreach ($prd_ids as $ids )
         {
            $product=Products::find($ids);
            $arr[$i]=$product[0];
            $i++;
           
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
