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

Route::group(['namespace' => 'Api\Auth'], function (){
    Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthenticationController::class,'login']);
    Route::post('/register', [\App\Http\Controllers\Api\Auth\RegisterController::class,'register']);
});

Route::group(['middleware' => 'auth:api'], function()
{
    Route::get('/user', function (Request $request) {
        return \Illuminate\Support\Facades\Auth::user();
    });

    Route::post('/logout', [\App\Http\Controllers\Api\Auth\AuthenticationController::class,'logout']);

    Route::apiResource('books', \App\Modules\Book\Http\Controllers\BookController::class);

    Route::get('/all-users', [\App\Modules\User\Http\Controller\UserController::class,'allUsers']);
    Route::get('/user-toggle/{id}', [\App\Modules\User\Http\Controller\UserController::class,'toggleStatus']);
    Route::get('/user-books/{id}', [\App\Modules\User\Http\Controller\UserController::class,'userBooks']);

});

Route::get('/active-user-books', [\App\Modules\User\Http\Controller\UserController::class,'allActiveUsersBooks']);

