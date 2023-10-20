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

    // Menu Settings
    Route::prefix('settings')->group(function () {
        Route::get('/address', 'settings\AddressController@index')->name('settings.address');
        Route::get('/address/new', 'settings\AddressController@create')->name('settings.address.create');
        Route::post('/address/store', 'settings\AddressController@store')->name('settings.address.store');
        Route::get('/address/destroy/{id}', 'settings\AddressController@destroy')->name('settings.address.destroy');
        Route::get('/address/edit/{id}', 'settings\AddressController@edit')->name('settings.address.edit');

    });

    // CEK TARIF
    Route::get('/estimate/tarif', 'App\Http\Controllers\Api\Ninja\Estimate_price\EstimateTarifController@index');
    Route::post('/search/estimate/rate/shipping', 'App\Http\Controllers\Api\Ninja\Estimate_price\EstimateTarifController@search');


    // Ajax
    Route::prefix('ajax')->group(function () {
        Route::get('/address/province', 'settings\AddressController@ajax_province');
        Route::get('/address/city/{provinceId}', 'settings\AddressController@ajax_city');
        Route::get('/address/district/{cityId}', 'settings\AddressController@ajax_district');
        Route::get('/address/subdistrict/{districtId}', 'settings\AddressController@ajax_subdistrict');
        Route::get('/address/postalcode/{subdistrictId}', 'settings\AddressController@ajax_postalcode');

        Route::get('/pengembalian/address/province', 'settings\AddressController@ajax_pengembalian_province');
        Route::get('/pengembalian/address/city/{provinceId}', 'settings\AddressController@ajax_pengembalian_city');
        Route::get('/pengembalian/address/district/{cityId}', 'settings\AddressController@ajax_pengembalian_district');
        Route::get('/pengembalian/address/subdistrict/{districtId}', 'settings\AddressController@ajax_pengembalian_subdistrict');
        Route::get('/pengembalian/address/postalcode/{subdistrictId}', 'settings\AddressController@ajax_pengembalian_postalcode');
        Route::get('/suggest/address', 'App\Http\Controllers\Api\Ninja\Estimate_price\EstimateTarifController@getAddress');

    });




});
