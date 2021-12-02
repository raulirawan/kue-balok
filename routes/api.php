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
    return $request->user();
});

Route::get('food','API\FoodController@all');
Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('user', 'API\AuthController@fetch');
    Route::post('user/update', 'API\AuthController@updateProfile');

    Route::get('transactions','API\TransactionController@all');
    Route::post('checkout','API\TransactionController@checkout');

    Route::post('logout', 'API\AuthController@logout');


});
