<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\AddressModel;
use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserUpdatedNotification;
use App\Models\Notification;
class profile extends Controller
{
    public function userData()
    {
        $user_id = Auth::user()->id;
        $user = DB::table('users')->where('id', $user_id)->first();

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
        $notificationData = [
            'user_id' => $user->id,

            'data' => 'Your Account Updated successfully.',
            'notifiable_id' => $user->id,
            'notifiable_type' => 'App\Models\User'
        ];

        $notification = new Notification($notificationData);
        $notification->save();
        return response()->json([
            'user' => $user,
            'notification' => $notification
    ]);
    }

    public function getOrdersDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $orders_id = DB::table('order')->where('user_id', $user_id)->pluck('id');
        $orders_details = [];

         if(count($orders_id)==0){
            return response()->json([
                'message'=> 'You havent purchased any orders yet'
            ]);
         }else{ for ($i = 0; $i < (count($orders_id)); $i++) {

            $orders_details[$i] = DB::table('order')
                ->join('order_items', 'order_items.order_id', '=', 'order.id')
                ->join('products', 'products.id', '=', 'order_items.prd_id')
                ->join('delivery_price','order.delivery_price_id','=','delivery_price.id')
                ->where('order_items.order_id', '=', $orders_id[$i])
                ->select([
                    'order.id',
                    'order.created_at',
                    'order_items.quantity as product_qnt',
                    'order_items.total_price',
                    'products.name',
                    'products.price as product_price',
                   'products.photo',
                   'products.description',
                ])
                ->get();
        }
        return $orders_details;
}
    }
    public function getOrdersTotal(){
        $user_id = Auth::user()->id;

        $orders_id = DB::table('order')->where('user_id', $user_id)->pluck('id');
        if(count($orders_id)==0){
            return response()->json([
                'message'=> 'You havent purchased any orders yet'
            ]);
         }else{

        $orders_total= DB::table('order')->where('user_id', $user_id)->pluck('total');
       $deliveryDetail=[];
        for($i=0;$i<count($orders_id);$i++){
            $deliveryDetail[$i]=   DB::table('order')
            ->join('delivery_price','delivery_price.id','=','order.delivery_price_id')
            ->where('order.id','=',$orders_id[$i])
            ->select('delivery_price.price','delivery_price.time','order.status','order.created_at')
            ->first();
        }
        $orders_details=[$orders_total,$deliveryDetail];
    }
         return $orders_details;}

    public function getFavItems()
    {
        $user_id = Auth::user()->id;
        $prd_ids = DB::table('favourite_item')->where('user_id', $user_id)->pluck('prd_id');
        $fav_items_details = [];

        for ($i = 0; $i < (count($prd_ids)); $i++) {
            $fav_items_details[$i] =  DB::table('favourite_item')
            ->join('products', 'favourite_item.prd_id', '=', 'products.id')
            ->where('products.id', $prd_ids[$i])
            ->select('products.*','favourite_item.id',"favourite_item.prd_id")
            ->get();

        }

        return $fav_items_details;
    }
public function deleteFaveitem(Request $request){

return  DB::table('favourite_item')->where('id', $request[0])->delete();

}

}
