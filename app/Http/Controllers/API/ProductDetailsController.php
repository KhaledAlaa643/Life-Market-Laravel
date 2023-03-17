<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ProductsDetailsResource;
use  App\Models\Products;
use  App\Models\ProductsRating;
use App\Models\ProuductsDiscount;
use App\Models\SubCategories;
use App\Models\delivery_price;




class ProductDetailsController extends Controller
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $details;
        $details= Products::find($id);
        
        // $Rating= ProductsRating::find($id);
       
        // $delivery_price = delivery_price::where('price',$id)->get();
       
        // $SubCategories = SubCategories::where('name',$id)->get();
       
        // $ProuductsDiscount = ProuductsDiscount::where('discount',$id)->get();
       
       
    //   $asd=  Response::json(
    //         ['Products'=> $details],
    //         ['ProductsRating'=>$Rating],
    //         ['delivery_price'=> $delivery_price],
    //         ['SubCategories'=>  $SubCategories],
    //         ['ProuductsDiscount'=>  $ProuductsDiscount],
    // );
    // return $asd;

    // return new ProductsDetailsResource( $details);
        return  $details;

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
