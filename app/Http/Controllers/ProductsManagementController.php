<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsManagementController extends Controller
{



public function getProductsBySubCat(Request $request){

     $data = DB::table('products')->where('sub_cat_id', '=', $request->Subcat)->get();
     if(count($data)==0){
        return response()->json(['message'=> "There is no Added Products Yet !"]);
     }
     return $data;

}

    public function getAllProducts(Request $request)
    {
        return $allProducts = DB::table('products')->select('products.*')->get();

    }


   public function createProduct(Request $request){
    $request->validate([
        'name' => 'required | string | unique:products,name',
        'description' => 'required | string',
        'sub_cat_id' => 'required |integer',
        'price_before_discount'=>'required | int',
        'price'=>'required | int',
        "brand"=>'required | string',
        "quantity"=>'required | int',
        "photo"=>'required | string'

    ]);
    $user_id= Auth::user()->id;

    $product = products::create([
        'name' => $request->name,
        'description' => $request->description,
        'sub_cat_id' => $request->sub_cat_id,
        "photo"=>$request->photo,
        'price_before_discount'=>$request->price_before_discount,
        'price'=>$request->price,
        "brand"=>$request->brand,
        "quantity"=>$request->quantity,
         "user_id"=>$user_id,
        'created_at' => now()
    ]);
    return $product;
    // return $request;
   }

   public function updateProduct(Request $request){
    $user_id= Auth::user()->id;

    $request->validate([
        'name' => 'required | string | unique:sub_categories,name',
        'description' => 'required | string',
        'sub_cat_id' => 'required |integer',
        'price_before_discount'=>'required | int',
        'price'=>'required | int',
        "brand"=>'required | string',
        "quantity"=>'required | int',
        "photo"=>'required | string',
         'id'=>'required | int'
    ]);
    $x=DB::table('products')->where('id', $request->id)
    ->update([
        "name"=>$request->name,
        'description' => $request->description,

        'sub_cat_id' => $request->sub_cat_id,
        "photo"=>$request->photo,
        'price_before_discount'=>$request->price_before_discount,
        'price'=>$request->price,
        "brand"=>$request->brand,
        "quantity"=>$request->quantity,
         "user_id"=>$user_id,
        'updated_at' => now()
    ]);
    $UpdatedSubCategory =DB::table('products')->where('id', $request->id)->first();
 return $UpdatedSubCategory;
// return $request;

    }
  public function  getProductById(Request $request){
    return DB::table('products')->where('id', '=', $request->id)->first();

    }

   public function deleteProduct(Request $request){
 DB::table('products')->where('id', '=', $request->id)->delete();

   }


}







