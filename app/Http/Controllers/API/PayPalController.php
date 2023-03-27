<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmkilive\PayPal\Services\PayPal as PayPalClient;
use Srmkilive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
  
    // public function RequestPayment( Request $request){
    //     $provider= new PayPalClient();

    //     $provider->setApiCredtials(config('paypal'));
    //     $paypalToken=$provider->getAccessToken();
    //     $amount=$request->amount;

    //     $respons=nmm;
    // } 
   



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }
}
