<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes
Route::post('/login','App\Http\Controllers\AuthController@login');
Route::post('/register','App\Http\Controllers\AuthController@register');



//protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout','App\Http\Controllers\AuthController@logout');
    Route::resource('/products','App\Http\Controllers\AuthController');
    Route::get('/user/{id}','App\Http\Controllers\AuthController@logout');
});
