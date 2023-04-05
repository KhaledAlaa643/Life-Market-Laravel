<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Products;
use  App\Models\SubCategories;
class SearchConroller extends Controller
{
    public function search ($request){
        $arr[]=[];
        $i=0;

        $sub_cat=SubCategories::where('name','LIKE', "%{$request}%")->get("id");
        $product=Products::where('name','LIKE', "%{$request}%")->get();
        $brand=Products::where('brand','LIKE', "%{$request}%")->get();

       
        foreach($product as $category)
        { 
            if($category->quantity > 0){
                $arr[$i]=$category;
                $i++;
            }
        }

        foreach($brand as $category)
        {
            if($category->quantity > 0){
                $arr[$i]=$category;
                $i++;
            }  
        }

        if (count ($sub_cat)!=0)
        {
            $sub_cat_products=Products::where('sub_cat_id',$sub_cat[0]["id"])->get();
            foreach($sub_cat_products as $category)
            {
                if($category->quantity > 0){
                    $arr[$i]=$category;
                    $i++;
                }    
            } 
        }

        if (count($arr)!=0)
        {
            return array_unique($arr);

        }
        else
        {
            $arr[0]="no such product with that name";
            return $arr;
        }

    }

    
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
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