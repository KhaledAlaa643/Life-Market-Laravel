<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use Stripe\Charge;
use Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\AuthenticationException;

class PaymentController extends Controller
{

    public function stripePost( Request $request ){

            try{

                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                $user_id = Auth::user()->id;

                $request->validate([
                    'number'=>'required | min:16 ',
                    'exp_month'=>'required | max:12',
                    'exp_year'=>'required',
                    'cvc'=>'required  | max:3',
                ]);

                  $res = $stripe->tokens->create([
                    'card' => [
                        'number'=>$request->number,
                        'exp_month'=>$request->exp_month,
                        'exp_year'=>$request->exp_year,
                        'cvc'=>$request->cvc,
                    ],

                  ]);

                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                   $response = $stripe->charges->create([
                   'user_agent'=>$user_id,
                    'amount' => $request->amount,
                    'currency' => 'usd',
                    'source' => $res->id,
                    'description' => $request->description,
                   ]);

                    return response()->json([$response->status], 201);

               }

                catch(Exception $ex){
                    return response()->json(['response'=> 'Error'],500);
                }
           }


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
