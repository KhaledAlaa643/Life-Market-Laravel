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

            // $user_id=Auth::user()->id;
            $status=order::where('user_id',4)->get();
            return $status;
      }

      public function getOrders( ){
        
            // $user_id=Auth::user()->id;
            $c=DB::table('order')
            ->join('users','users.id','=','order.user_id')
            ->join('delivery_price','delivery_price.id','=','order.delivery_price_id')
            ->where('order.user_id','=',4)
            ->insert('order.status','=','processing',
            'order.total',
            'order.user_id',
            'delivery_price.price',
            'delivery_price.time'
            )
            ->get();

            return $c;
        
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
