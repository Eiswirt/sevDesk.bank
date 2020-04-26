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

Route::apiResource('/checking', 'CheckingAccountController');
Route::apiResource('/credit', 'CreditAccountController');
Route::apiResource('/passbook', 'PassbookController');
Route::put('/checking/{checking}/deposite/', 'CheckingaccountController@deposite');
Route::put('/checking/{checking}/withdraw/', 'CheckingaccountController@withdraw');
Route::put('/checking/{id_sender}/transfer/{id_recipient}/', 'CheckingaccountController@transfer');
