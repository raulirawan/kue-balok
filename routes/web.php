<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::prefix('admin')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/dashboard','DashboardController@index')->name('admin.dashboard.index');

        Route::resource('user', UserController::class);
        Route::resource('food', FoodController::class);
    });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');