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

Route::middleware(['auth', 'verified', 'web'])->group(function () {
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
        Route::delete('/address/destroy/{id}', 'settings\AddressController@destroy')->name('settings.address.destroy');
        Route::get('/address/edit/{id}', 'settings\AddressController@edit')->name('settings.address.edit');
        Route::post('/address/update/{id}', 'settings\AddressController@update')->name('settings.address.update');
    });

    // Menu Create order
    Route::prefix('ninja')->group(function () {
        Route::get('/create/order', 'OrderNinjaController@index')->name('create.ninja.order');
        Route::post('/create/order/store', 'OrderNinjaController@store')->name('store.ninja.order');
        Route::get('/order/history', 'OrderNinjaHistoryController@index')->name('history.ninja.order');
        Route::get('/order/{id}', 'OrderNinjaHistoryController@show')->name('history.ninja.order.show');
        Route::get('/order/list/{id}', 'OrderNinjaHistoryController@order_list');

        // Tracking form
        Route::get('/tracking/order', 'Api\Ninja\tracking_order\TrackingNinjaController@index');
        Route::post('/tracking/order/search', 'Api\Ninja\tracking_order\TrackingNinjaController@search');

        // Generate waybill
        Route::get('/print/waybill/{id}', 'Api\Ninja\print_waybill\WaybillController@index');
        Route::post('/print/waybill', 'Api\Ninja\print_waybill\WaybillController@print');
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

        Route::get('/cari-alamat', 'OrderNinjaController@searchAlamat');
        Route::post('/estimate/rate/shipping/{l1_jemput}/{l2_jemput}/{l1_kirim}/{l2_kirim}/{berat}', 'OrderNinjaController@estimate_price');

    });


});

Route::prefix('webhook/ninja')->group(function () {
    Route::post('/pending-pickup', 'Api\Ninja\webhook\WebhookNinjaController@handlePendingPickup');
    Route::post('/cancel-pickup', 'Api\Ninja\webhook\WebhookNinjaController@handleCancelled');

});

