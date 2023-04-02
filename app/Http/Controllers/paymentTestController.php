<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class paymentTestController extends Controller
{


public function createCharge(Request $request)
{
// Set your Stripe API key
Stripe::setApiKey(env('STRIPE_SECRET'));

// Create a new charge
try {
$charge = Charge::create([
'amount' => 2000,
'currency' => 'USD',
'description' => 'Payment for product',
'source' => $request->input('stripeToken'),
]);

// Handle successful payment
return redirect()->route('payment.success');

} catch (\Stripe\Exception\CardException $e) {
// Handle card error
return redirect()->route('payment.error');
} catch (\Stripe\Exception\RateLimitException $e) {
// Handle rate limit error
return redirect()->route('payment.error');
} catch (\Stripe\Exception\InvalidRequestException $e) {
// Handle invalid request error
return redirect()->route('payment.error');
} catch (\Stripe\Exception\AuthenticationException $e) {
// Handle authentication error
return redirect()->route('payment.error');
} catch (\Stripe\Exception\ApiConnectionException $e) {
// Handle API connection error
return redirect()->route('payment.error');
} catch (\Stripe\Exception\ApiErrorException $e) {
// Handle generic API error
return redirect()->route('payment.error');
}
}
}
