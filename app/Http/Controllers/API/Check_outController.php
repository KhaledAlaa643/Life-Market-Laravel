<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\order;
use App\Models\order_items;
use App\Models\Cart;
use App\Models\delivery_price;
use App\Models\Products;

class Check_outController extends Controller
{


    


    public function getGovernorate($Governorate )
      {                                         
            $gov=delivery_price::where('governorate',$Governorate)->get();

            return $gov;
      }

      public function getStatus(){

            $user_id=Auth::user()->id;
            $status=order::where('user_id',$user_id)->get();
            return $status;
      }

      public function createOrder(string $id ){
        
            $user_id=Auth::user()->id;

            $cart[]=[];
            $cart=Cart::where('user_id',$user_id)->get();

            foreach ($cart as $prd) {
        
                $myOrder= new order_items();
                $myOrder->quantity=$prd->quantity;
                $myOrder->total_price=$prd->price * $prd->quantity;
                $myOrder->prd_id=$prd->prd_id;
                $myOrder->order_id= $id;
                $myOrder->save();

                $product=Products::find($prd->prd_id);
                $product->quantity-=$prd->quantity;
                $product->save();
        
            }
             
            $cart=Cart::where('user_id',$user_id)->delete();

            return $product;
      }

     
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
        // $user_id=Auth::user()->id;
        $statusOrder=new order();
        $statusOrder->status='processing';
        $statusOrder->total=$request->total;
        $statusOrder->user_id=$request->user_id;
        $statusOrder->delivery_price_id=$request->delivery_price_id;
        $statusOrder->created_at=now();
        $statusOrder->save();
        return $statusOrder;
       
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
