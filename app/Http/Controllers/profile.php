<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressModel;
use App\Models\order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class profile extends Controller
{
    public function userData()
    {
        $user_id = Auth::user()->id;
        $user = DB::table('users')->where('id', $user_id)->get();

        return $user;
    }
    public function updateUserData(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,

            'updated_at' => now()
        ]);
        return response()->json(['user' => $user]);
    }

    public function getOrders(Request $request)
    {
        $user_id = Auth::user()->id;
        $orders_id = DB::table('order')->where('user_id', $user_id)->pluck('id');

        $orders_details = [];
        for ($i = 0; $i < (count($orders_id)); $i++) {

            $orders_details[$i] = DB::table('order')
                ->join('order_items', 'order_items.order_id', '=', 'order.id')
                ->join('products', 'products.id', '=', 'order_items.prd_id')
                ->where('order_items.order_id', '=', $orders_id[$i])
                ->select([
                    'order.total',
                    'order_items.quantity',
                    'order_items.total_price',
                    'products.name',
                    'products.description',
                    'products.price',
                    'products.brand',

                ])
                ->get();
        }

        return $orders_details;


    }
    public function getFavItems()
    {
        $user_id = Auth::user()->id;
        $prd_ids = DB::table('favourite_item')->where('user_id', $user_id)->pluck('prd_id');
        $fav_items_details = [];
        for ($i = 0; $i < (count($prd_ids)); $i++) {
            $fav_items_details[$i] = DB::table('products')->where('id', $prd_ids[$i])->get();

        }

        return $fav_items_details;
    }



}
