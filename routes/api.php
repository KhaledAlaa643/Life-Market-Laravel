<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriesConroller;
use App\Http\Controllers\API\SubCategoriesConroller;
use App\Http\Controllers\API\ProductsConroller;
use App\Http\Controllers\API\ProductsRatingConroller;
use App\Http\Controllers\API\ProductsDiscountConroller;
use App\Http\Controllers\API\SearchConroller;
use App\Http\Controllers\API\OffersConroller;
use App\Http\Controllers\API\OfferProductsConroller;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories',CategoriesConroller::class);
Route::apiResource('sub_categories',SubCategoriesConroller::class);
Route::apiResource('products',ProductsConroller::class);
Route::apiResource('rating',ProductsRatingConroller::class);
Route::apiResource('discount',ProductsDiscountConroller::class);
Route::apiResource('offers',OffersConroller::class);

Route::group(['middleware' => ['api']], function(){
   
 Route::post('search', 'App\Http\Controllers\API\SearchConroller@search');
});
Route::apiResource('offers_products',OfferProductsConroller::class);

Route::group(['middleware' => ['api']], function(){
   
    Route::get('category/products/{num}', 'App\Http\Controllers\API\CategoriesConroller@getproducts');
   });