<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return \Illuminate\Support\Facades\Auth::user();
});

Route::get('users', function(){
    return \App\Models\User::all();
});

Route::group(['namespace' => 'Api\Auth'], function (){
    Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthenticationController::class,'login']);
    Route::post('/logout', [\App\Http\Controllers\Api\Auth\AuthenticationController::class,'logout'])->middleware('auth:api');
    Route::post('/register', [\App\Http\Controllers\Api\Auth\RegisterController::class,'register']);

});
Route::apiResource('books', \App\Modules\Book\Http\Controllers\BookController::class);
