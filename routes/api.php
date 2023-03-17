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
use App\Http\Controllers\API\FavouriteItemConroller;
use App\Http\Controllers\API\ContactUsConroller;

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
Route::apiResource('about_us',ContactUsConroller::class);


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
   