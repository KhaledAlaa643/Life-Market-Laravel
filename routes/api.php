<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriesConroller;
use App\Http\Controllers\API\SubCategoriesConroller;
use App\Http\Controllers\API\ProductsConroller;
use App\Http\Controllers\API\ProductsRatingConroller;
use App\Http\Controllers\API\ProductsDiscountConroller;
use App\Http\Controllers\API\SearchConroller;
use App\Http\Controllers\API\OffersConroller;
use AApp\Http\Resources\ProductDetailsController;
use App\Http\Controllers\API\ShoppingCartController;
use App\Http\Controllers\API\OfferProductsConroller;
use App\Http\Controllers\API\FavouriteItemConroller;
use App\Http\Controllers\API\GallreyPhotoController;
use App\Http\Controllers\API\ReviewProductController;
use App\Http\Controllers\API\ContactUsConroller;
use App\Http\Controllers\API\Check_outController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\DeliveryController;
use App\Http\Controllers\API\PaymentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories',CategoriesConroller::class);
Route::apiResource('sub_categories',SubCategoriesConroller::class);
Route::apiResource('products',ProductsConroller::class);
Route::apiResource('rating',ProductsRatingConroller::class);
Route::apiResource('discount',ProductsDiscountConroller::class);
Route::apiResource('offers',OffersConroller::class);
Route::apiResource('offers_products',OfferProductsConroller::class);
Route::apiResource('favourite_item',FavouriteItemConroller::class);
Route::apiResource('contact_us',ContactUsConroller::class);


Route::group(['middleware' => ['api']], function(){
   //search for product using name ,brand ,sub cat
 Route::post('search', 'App\Http\Controllers\API\SearchConroller@search');  
});

Route::group(['middleware' => ['api']], function(){            
     //get products by category id 
    Route::get('category/products/{num}', 'App\Http\Controllers\API\CategoriesConroller@getproducts');
   });


   
Route::group(['middleware' => ['api']], function(){              
    //update product quantity& selling count by prod id 
    Route::put('update/products/{num}', 'App\Http\Controllers\API\ProductsConroller@updateproduct');
     //update rate of product based on product id from prd rate table
    Route::put('products/rate/{num}', 'App\Http\Controllers\API\ProductsConroller@getrate');
    //get top rating products
    Route::get('toprating/products', 'App\Http\Controllers\API\ProductsConroller@top_rating_products');
    //get top selling products
    Route::get('topselling/products', 'App\Http\Controllers\API\ProductsConroller@top_selling_products');

   });

Route::apiResource('productdetails', App\Http\Controllers\API\ProductDetailsController::class);
Route::apiResource('admin',App\Http\Controllers\API\AdminController::class);
Route::apiResource('customer',App\Http\Controllers\API\CustomerController::class);
Route::apiResource('delivery',App\Http\Controllers\API\DeliveryController::class);
Route::apiResource('payment',App\Http\Controllers\API\PaymentController::class);
//get product in cart
Route::apiResource('cart',App\Http\Controllers\API\ShoppingCartController::class);
// get update quantity
// Route::group(['middleware' => ['api','auth:sanctum']], function(){

//     Route::get('increment/shoppingcart/{id}', 'App\Http\Controllers\API\ShoppingCartController@incrementQuant');
  
//     Route::get('decrement/shoppingcart/{id}', 'App\Http\Controllers\API\ShoppingCartController@decrementQuant');
 
//     Route::get('getcartprd', 'App\Http\Controllers\API\ShoppingCartController@index');
 
//    });

Route::get('status/checkout','App\Http\Controllers\API\Check_outController@getStatus');
Route::get('governorate/checkout/{governorate}', 'App\Http\Controllers\API\Check_outController@getGovernorate');
  
Route::post('orders/checkout', 'App\Http\Controllers\API\Check_outController@createOrder');
  
Route::post('statusorder/checkout', 'App\Http\Controllers\API\Check_outController@store');
  


Route::group(['middleware' => ['api']], function(){
    Route::get('gallrey/productdetails/{id}', 'App\Http\Controllers\API\GallreyPhotoController@getgallery');
   });

Route::group(['middleware' => ['api']], function(){
    Route::get('review/productdetails/{id}', 'App\Http\Controllers\API\ReviewProductController@getRating');
   });
//public routes
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/password-reset', 'App\Http\Controllers\passwordReset@sendEmail');



//protected routes
Route::middleware(['auth:sanctum'])->group(function () {



    //profile routes
    Route::get('/user/data', 'App\Http\Controllers\profile@userData');
    Route::post('/user/update', 'App\Http\Controllers\profile@updateUserData');

    Route::get('/address', 'App\Http\Controllers\AddressController@getAddress');
    Route::post('/address/update', 'App\Http\Controllers\AddressController@updateAddress');
    Route::post('/address/create', 'App\Http\Controllers\AddressController@createAddress');


    Route::get('/orders', 'App\Http\Controllers\profile@getOrders');
    Route::get('/topsellings', 'App\Http\Controllers\profile@getTopSelling');
    Route::get('/saveditems', 'App\Http\Controllers\profile@getSavedItems');

    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
});
