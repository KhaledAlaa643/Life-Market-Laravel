<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order_items;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // $cart= order_items::select('quantity','total_price','prd_id','order_id')->get();
        $cart= order_items::all();
        return  $cart;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $addToCart= $request->order_items()->create($request->all());
        // return $addToCart;  

        // "id": 3,
        // "quantity": 5,
        // "total_price": 260,
        // "created_at": "2023-03-20T20:45:52.000000Z",
        // "updated_at": "2023-03-15T00:24:18.000000Z",
        // "prd_id": 7,
        // "order_id": 3
        
       $product = new order_items;
       $product->quantity = $request->quantity;
       $product->total_price = $request->total_price;
       $product->created_at = $request->created_at;
       $product->updated_at = $request->updated_at;
       $product->prd_id = $request->prd_id;
       $product->order_id = $request->order_id;
      

       $product->save();

       return $product;


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

        // $remove =order_items ::find($id);
        // $this->authorize('delete', $remove);
        
        // $remove->delete();
        // return back();
        
        $id=order_items::where('id',$id)->delete();
        
        return response()->json(null, 204);

       
       
    }
}
