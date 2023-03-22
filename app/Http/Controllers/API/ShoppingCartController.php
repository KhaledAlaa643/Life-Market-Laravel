<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order_items;
use App\Models\Cart;
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

   

     public function addQuantity( string $prd_id){
        $user_id=Auth::user()->id;
      
          $x=DB::table('cart')->where('user_id',$user_id )->where('prd_id', $prd_id)->get('quantity');
          
          $y=DB::table('products')->where('id', $prd_id)->get('quantity');

          if( $y[0]->quantity > $x[0]->quantity){

            //   $x->increment('quantity');
            $x=DB::table('cart')->where('user_id',$user_id )->where('prd_id', $prd_id)->increment('quantity');
            return 'add scce';

          }else{
            return ' out of stock';
          }
    
     }
     public function decrementQuant( string $prd_id){
        $user_id=Auth::user()->id;
      
          $x=DB::table('cart')->where('user_id',$user_id )->where('prd_id', $prd_id)->get('quantity');
          
          $y=DB::table('products')->where('id', $prd_id)->get('quantity');

          if( $x[0]->quantity > 0){

            $x=DB::table('cart')->where('user_id',$user_id )->where('prd_id', $prd_id)->decrement('quantity');
            return 'mains scce';

          }else{
            return ' out of stock';
          }
    
     }

    

    public function index()
    {
        $user_id=Auth::user()->id;
      
          $x=DB::table('cart')->where('user_id', 28 )->get();

          return $x;
          
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
        $user_id =Auth::user()->id;
        $x= DB::table('cart')
        ->join('users','users.id','=','cart.user_id')
        ->join('products','products.id','=','cart.prd_id')
        ->where('cart.user_id','=',$user_id)
        ->select('cart.*', 
        'products.name',
        'products.description',
        'products.price',
        'products.brand',
        'products.photo',
        'products.prd_rating',
        )
        ->get();
       
        return $x;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        
        $id=Cart::where('id',$id)->delete();
        
        return 'sccsess delete';

       
       
    }
}
