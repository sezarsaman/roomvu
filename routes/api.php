<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(
    [
        'namespace' => 'App\Http\Controllers',
    ],
    function () {

        Route::get('get-balance/{user_id}', 'UserBalanceController@show')
            ->name('user_balance.show');


        Route::post('add-money', 'TransactionController@store')
            ->name('transaction.store');
    }
);
