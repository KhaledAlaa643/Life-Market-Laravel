<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\delivery_price;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Order_Items;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

    public function order(){
        $order = DB::table('order as o')
            ->join('users', 'users.id', '=', 'o.user_id')
            ->select('o.id', 'o.created_at', 'o.total', 'first_name', 'last_name', 'email', 'status')
            ->orderBy('o.created_at', 'desc')
            ->get();
            $order = $order->map(function($item, $index) {
                $item->index = $index + 1;
                return $item;
            });
        return $order;
    }



    public function orderview($orderId){
        $ordered = DB::table('products as p')
            ->join('order_items', 'order_items.prd_id', '=', 'p.id')
            ->join('order', 'order.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'order.user_id')            
            ->join('address', 'address.user_id', '=', 'users.id')
            ->join('delivery_price', 'delivery_price.id', '=', 'order.delivery_price_id')
            ->select(
                'order.id as order_id','order.status','order.created_at','order.total as order_total',
                'order_items.quantity',
                'p.name as product_name','p.photo as product_photo','p.description as product_description','p.price as product_price',
                'address.street','address.city', 'address.governorate', 'address.zip_code',
                'users.first_name','users.last_name','users.email','users.phone',
                'delivery_price.price as delivery_price','delivery_price.time as delivery_time'
            )
            ->where('order.id', '=', $orderId)
            ->get();
        return $ordered;
    }



    public function orderViewByUserId(){
        $userId = Auth::id();
        $ordered = DB::table('products as p')
            ->join('order_items', 'order_items.prd_id', '=', 'p.id')
            ->join('order', 'order.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'order.user_id')            
            ->join('address', 'address.user_id', '=', 'users.id')
            ->join('delivery_price', 'delivery_price.id', '=', 'order.delivery_price_id')
            ->select(
                'order.id as order_id','order.status','order.created_at','order.total as order_total',
                'order_items.quantity',
                'p.name as product_name','p.description as product_description','p.price as product_price',
                'address.street','address.city', 'address.governorate', 'address.zip_code',
                'users.phone',
                'delivery_price.price as delivery_price ','delivery_price.time as delivery_time'
            )
            ->where('order.user_id', '=', $userId)
            ->get();
        return $ordered;
    }





    public function index($user_id)
    {
        $orders = Order::where('user_id', $user_id)->get();

        return response()->json($orders);
    }


//     /**
//      * Update the specified resource in storage.
//      */
    public function update(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->status = $request->input('status');
        $order->save();
        return response()->json(['message' => 'Order status updated successfully']);
    }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
// }
}