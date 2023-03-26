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
            ->select(DB::raw('SUM(order_items.quantity * p.price) as totaled'), 'order_id','p.name' ,'p.photo', 'p.description', 'p.id', 'p.price', DB::raw('SUM(order_items.quantity) as total_quantity'), 'users.first_name', 'users.last_name', 'users.email','users.phone', 'address.street', 'address.city', 'address.governorate', 'address.zip_code','order.created_at')
            ->where('order_items.order_id', '=', $orderId)
            ->groupBy('p.id', 'order_id','p.name','p.photo', 'p.description', 'p.price', 'users.first_name', 'users.last_name', 'users.email','users.phone', 'address.street', 'address.city', 'address.governorate', 'address.zip_code')
            ->get();
             $ordered=$ordered->map(function($item, $index) {
                $item->index = $index + 1;
                return $item;
            });
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