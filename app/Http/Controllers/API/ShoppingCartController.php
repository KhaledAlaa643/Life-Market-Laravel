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
        // 

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
