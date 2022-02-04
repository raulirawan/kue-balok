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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('pdf', function () {
//     $pdf = PDF::loadView('struk.struk');
//     return $pdf->download('invoice.pdf');
// });
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['admin', 'auth'])
    ->group(function () {
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');

        Route::resource('user', UserController::class);
        Route::resource('food', FoodController::class);

        Route::get('transaction', 'TransactionController@index')->name('transaction.index');
        Route::post('transaction/add/cart', 'TransactionController@addtoCart')->name('add.to.cart');
        Route::delete('transaction/delete/cart', 'TransactionController@deleteCart')->name('delete.cart');
        Route::delete('transaction/delete/reset/all', 'TransactionController@deleteAllCart')->name('delete.all.cart');

        Route::post('transaction/create', 'TransactionController@createTransaction')->name('transaction.create');


        Route::get('load/cart', 'TransactionController@loadDataCart')->name('load.cart');
        Route::get('print/bon/{id}', 'TransactionController@printBon')->name('printBon');

        // Laporan
        Route::get('laporan','ReportController@index')->name('report.index');
        Route::get('laporan/transaction/detail/{id}','ReportController@detail')->name('report.detail');

        Route::get('order-online','OnlineTransactionController@index')->name('order-online.index');
        Route::get('order-online/detail/{id}','OnlineTransactionController@detail')->name('order-online.detail');

        Route::get('order-online/pending/request','OnlineTransactionController@indexPending')->name('order-online.pending');

        Route::put('accept/order/{id}','OnlineTransactionController@accept')->name('accept.order');
        Route::put('reject/order/{id}','OnlineTransactionController@reject')->name('reject.order');
    });



Auth::routes([
    'register' => false,
    'reset' => false,

]);

Route::get('/home', 'HomeController@index')->name('home');
