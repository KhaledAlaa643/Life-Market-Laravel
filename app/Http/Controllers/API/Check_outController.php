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

      public function createOrder(Request $request ){
        
            // $user_id=Auth::user()->id;

            $cart[]=[];
            $cart=Cart::where('user_id',28)->get();

            // for( $i=0; $i <= count($cart); $i++ ){

            // }
           
            foreach ($cart as $myOrder) {
              
                 // $myOrder[$i]=DB::table('order_items')
                // ->insert('quantity','total_price','prd_id','order_id')
                // ->value(4,2000,4,4)

                $myOrder= new order_items();
              
                $myOrder->quantity=$request->quantity;
                $myOrder->total_price=$request->total_price;
                $myOrder->prd_id=$request->prd_id;
                $myOrder->order_id=$request->order_id;
                $myOrder->created_at=now();
                $myOrder->save();
        
            }
            return $myOrder;
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
        // $user_id =Auth::user()->$id;
        // $address= Address::where('user_id',$id)->get();
        // $address= DB::table('address')->where('user_id', $user_id)->get();


        // if(count($address )==0){

       
        //     return ;
        // }

        // return $address->get();

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
