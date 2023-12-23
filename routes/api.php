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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/ninja/accessToken', 'Api\Auth\AuthNinjaController@getAccessToken')->name('api.ninja.auth_access_point');
//    //return $request->user();
//});
Route::get('ninja/auth/token', 'Api\Auth\AuthNinjaController@getToken');
Route::get('ninja/auth/token/job', 'Api\Auth\AuthNinjaJobController@index');


