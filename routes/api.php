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
use App\Http\Controllers\API\CartConroller;
use App\Http\Controllers\API\OrderConroller;
use App\Http\Controllers\API\UserConroller;

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
Route::middleware('auth:sanctum')->apiResource('rating',ProductsRatingConroller::class);
Route::apiResource('discount',ProductsDiscountConroller::class);
Route::apiResource('offers',OffersConroller::class);
Route::apiResource('offers_products',OfferProductsConroller::class);
Route::middleware('auth:sanctum')-> apiResource('favourite_item',FavouriteItemConroller::class);
Route::apiResource('contact_us',ContactUsConroller::class);
Route::apiResource('order',OrderConroller::class);
Route::middleware('auth:sanctum')->apiResource('cart',CartConroller::class);
Route::apiResource('userss',UserConroller::class);


Route::group(['middleware' => ['api']], function(){
   //search for product using name ,brand ,sub cat
 Route::get('search/{name}', 'App\Http\Controllers\API\SearchConroller@search');
 Route::post('search', 'App\Http\Controllers\API\SearchConroller@search');
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
    //get count of orders
    Route::get('orders/count', 'App\Http\Controllers\API\OrderConroller@getordercount');
   //search for product using name ,brand ,sub cat
    Route::get('search/{name}', 'App\Http\Controllers\API\SearchConroller@search');
     //get products by category id
    Route::get('category/products/{num}', 'App\Http\Controllers\API\CategoriesConroller@getproducts');
    //get users count
    Route::get('users/count', 'App\Http\Controllers\API\UserConroller@getuserscount');
    //get products count
    Route::get('product/count', 'App\Http\Controllers\API\ProductsConroller@getproductscount');

    Route::get('offers_products/select/{id}', 'App\Http\Controllers\API\OfferProductsConroller@add_offer_products');
    //calc_total_income
    Route::get('total_income', 'App\Http\Controllers\API\OrderConroller@calc_total_income');
    //get offer by id
    Route::get('offer/{id}', 'App\Http\Controllers\API\OffersConroller@get_offer_by_id');
    //get order id and date
    Route::get('orderss', 'App\Http\Controllers\API\OrderConroller@get_orders_id_and_date');
    //store new fav item with prd_id
    Route::middleware('auth:sanctum')->post('fav_item/{id}', 'App\Http\Controllers\API\FavouriteItemConroller@store_new_favourite_item_by_id');
    //check
    Route::middleware('auth:sanctum')->get('fav/{id}', 'App\Http\Controllers\API\FavouriteItemConroller@check');

   });


Route::apiResource('productdetails', App\Http\Controllers\API\ProductDetailsController::class);
Route::apiResource('admin',App\Http\Controllers\API\AdminController::class);
Route::apiResource('customer',App\Http\Controllers\API\CustomerController::class);
Route::apiResource('delivery',App\Http\Controllers\API\DeliveryController::class);
Route::apiResource('payment',App\Http\Controllers\API\PaymentController::class);
//get product in cart
// Route::apiResource('cart',App\Http\Controllers\API\ShoppingCartController::class);
// get update quantity
Route::group(['middleware' => ['api','auth:sanctum']], function(){

    Route::get('increment/shoppingcart/{id}', 'App\Http\Controllers\API\ShoppingCartController@incrementQuant');

    Route::get('decrement/shoppingcart/{id}', 'App\Http\Controllers\API\ShoppingCartController@decrementQuant');

    Route::get('getcartprd', 'App\Http\Controllers\API\ShoppingCartController@index');

    Route::get('cartprd','App\Http\Controllers\API\ShoppingCartController@show');

    Route::delete('delprdfromcart/{id}','App\Http\Controllers\API\ShoppingCartController@destroy');

});

  // api for check out
Route::group(['middleware' => ['api','auth:sanctum']], function(){
    Route::get('status/checkout','App\Http\Controllers\API\Check_outController@getStatus');
    Route::get('governorate/checkout/{governorate}', 'App\Http\Controllers\API\Check_outController@getGovernorate');
    Route::get('orders/checkout/{id}', 'App\Http\Controllers\API\Check_outController@createOrder');
    Route::post('checkout/createorder', 'App\Http\Controllers\API\Check_outController@store');
});



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

    Route::get('/fav-items', 'App\Http\Controllers\profile@getFavItems');
    Route::post('/fav-item/delete', 'App\Http\Controllers\profile@deleteFaveitem');
    Route::get('/orders', 'App\Http\Controllers\profile@getOrdersDetails');
    Route::get('/orders/total', 'App\Http\Controllers\profile@getOrdersTotal');
    Route::get('/topsellings', 'App\Http\Controllers\profile@getTopSelling');

    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');


    Route::post('addprdtocart', 'App\Http\Controllers\API\CartConroller@store');
    //Dashboard Routes
    //category
    Route::post('/dashboard/create/category','App\Http\Controllers\CategoryManage@createCategory');
    Route::delete('/dashboard/products/delete/category/{id}','App\Http\Controllers\CategoryManage@deleteCategory');
    Route::post('/dashboard/products/update/category','App\Http\Controllers\CategoryManage@updateCategory');
    Route::get('/dashboard/products/all-categories','App\Http\Controllers\CategoryManage@getcategories');
    Route::get('/dashboard/category/{id}','App\Http\Controllers\CategoryManage@getCategoryById');

    //sub-category
    Route::post('/dashboard/create/sub-category','App\Http\Controllers\SubCategoryManage@createSubCategory');
    Route::delete('/dashboard/products/delete/sub-category/{id}','App\Http\Controllers\SubCategoryManage@deleteSubCategory');
    Route::post('/dashboard/products/update/sub-category','App\Http\Controllers\SubCategoryManage@updateSubCategory');
    Route::get('/dashboard/products/all-sub-categories','App\Http\Controllers\SubCategoryManage@getSubCategories');
    Route::get('/dashboard/sub-category/{id}','App\Http\Controllers\SubCategoryManage@getSubCategoryById');
    //product
    Route::post('/dashboard/products/create/product','App\Http\Controllers\ProductsManagementController@createProduct');
    Route::post('/dashboard/products/update/product','App\Http\Controllers\ProductsManagementController@updateProduct');
    Route::get('/dashboard/product/{id}','App\Http\Controllers\ProductsManagementController@getProductById');
    Route::delete('/dashboard/products/delete/product/{id}','App\Http\Controllers\ProductsManagementController@deleteProduct');
    Route::get('/dashboard/products/by-sub_category/{Subcat}','App\Http\Controllers\ProductsManagementController@getProductsBySubCat');
    Route::get('/dashboard/products/all-products','App\Http\Controllers\ProductsManagementController@getAllProducts');


});
//////Order Dashboard routes/////////

Route::get('/orders', 'App\Http\Controllers\API\OrderController@order');
Route::put('/orders/{order_id}', 'App\Http\Controllers\API\OrderController@update');
Route::get('/orders/{order_id}','App\Http\Controllers\API\OrderController@orderview');
Route::middleware('auth:sanctum')->get('/ordersbyuserid','App\Http\Controllers\API\OrderController@orderViewByUserId');


/////////Make Notification Routes/////
Route::middleware('auth:sanctum')->get('/notifications', 'App\Http\Controllers\NotificationController@index');
Route::middleware('auth:sanctum')->post('/notifications/mark-as-read', 'App\Http\Controllers\NotificationController@markAsRead');
Route::middleware('auth:sanctum')->get('/notifications/unread-count', 'App\Http\Controllers\NotificationController@getUnreadCount');

