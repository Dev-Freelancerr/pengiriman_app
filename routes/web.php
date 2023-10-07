<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::view('/home', 'home')->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {

        return view('home');
    });


    Route::get('/', 'UserAccountRegisterController@home');


    // Simpan pendaftaran user
    Route::post('/store_register', 'UserAccountRegisterController@store_register');

    // Update pendafataran user jika di tolak user
  Route::post('/update_register', 'UserAccountRegisterController@update_register')->name('update.register');

    // Return view ke waiting room setelah registrasi


});
