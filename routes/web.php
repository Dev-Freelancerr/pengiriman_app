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
        Route::get('/get-batch', 'OrderNinjaHistoryController@getBatch');
        Route::get('/get-order/{id}', 'OrderNinjaHistoryController@getOrder')->name('ninja.getOrder');
        Route::delete('/order/cancel/{id}', 'OrderNinjaHistoryController@getCancel')->name('ninja.getCancel');



        Route::get('/order/{id}', 'OrderNinjaHistoryController@show')->name('history.ninja.order.show');
        Route::get('/order/list/{id}', 'OrderNinjaHistoryController@order_list');

        // Tracking form
        Route::get('/tracking/order', 'Api\Ninja\tracking_order\TrackingNinjaController@index');
        Route::post('/tracking/order/search', 'Api\Ninja\tracking_order\TrackingNinjaController@search');

        // Generate waybill
        Route::get('/print/waybill/{id}', 'Api\Ninja\print_waybill\WaybillController@index');
        Route::post('/print/waybill', 'Api\Ninja\print_waybill\WaybillController@print');
        Route::post('/print/all/waybill', 'Api\Ninja\print_waybill\WaybillController@print_all');

        Route::get('/export', 'OrderNinjaController@form_export');
        Route::post('/export', 'OrderNinjaController@exportExcel')->name('export');
        Route::post('/excel/upload', 'OrderNinjaController@upload')->name('upload');
    });

    Route::get('/download-sample', 'DownloadController@downloadSample')->name('download-sample');

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

    // Rute untuk setiap event
    Route::post('/pending-pickup', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.pending-pickup');
    Route::post('/picked-up', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.picked-up');
    Route::post('/pending-pickup-shipper-dropoff', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.pending-pickup-shipper-dropoff');
    Route::post('/pickup-exception-pending-reschedule', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.pickup-exception-pending-reschedule');
    Route::post('/arrived-at-origin-hub', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.arrived-at-origin-hub');
    Route::post('/arrived-at-transit-hub', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.arrived-at-transit-hub');

    Route::post('/arrived-at-destination-hub', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.arrived-at-destination-hub');
    Route::post('/in-transit-to-next-sorting-hub', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.in-transit-to-next-sorting-hub');
    Route::post('/on-vehicle-for-delivery', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.on-vehicle-for-delivery');
    Route::post('/at-pudo-pending-customer-collection', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.at-pudo-pending-customer-collection');
    Route::post('/delivered-collected-by-customer', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivered-collected-by-customer');

    Route::post('/delivered-left-at-doorstep', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivered-left-at-doorstep');
    Route::post('/delivered-received-by-customer', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivered-received-by-customer');
    Route::post('/delivery-exception-pending-reschedule', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivery-exception-pending-reschedule');
    Route::post('/delivery-exception-max-attempts-reached', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivery-exception-max-attempts-reached');
    Route::post('/delivery-exception-parcel-overstayed-at-pudo', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivery-exception-parcel-overstayed-at-pudo');

    Route::post('/delivery-exception-parcel-lost', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivery-exception-parcel-lost');
    Route::post('/delivery-exception-parcel-damaged', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivery-exception-parcel-damaged');
    Route::post('/delivery-exception-return-to-sender-initiated', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.delivery-exception-return-to-sender-initiated');
    Route::post('/returned-to-sender', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.returned-to-sender');
    Route::post('/cancelled', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhookV2')->name('webhook.cancelled');


    // //1. Staging ** D
    //     Route::post('/staging', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //2. On Vehicle for delivery (RTS) ** D
    //     Route::post('/onvehicle-fordelivery', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //3. Transfered to 3PL ** D
    //     Route::post('/transfered-to3pl', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End


    // //4. Pending Pickup D
    //     Route::post('/pending-pickup', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //5. Successfull Pickup D
    //     Route::post('/successfull-pickup', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //6. En-Route to Sorting Hub D
    //     Route::post('/enroute-tosorting-hub', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //7. Canceled Order D
    //     Route::post('/cancel-pickup', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //8. Arrived at Sorting Hub D
    //     Route::post('/arrivedat-sortinghub', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //9. Arrived at Origin Hub
    //     Route::post('/arrivedat-originhub', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //10. Pending Reschedule D
    //     Route::post('/pending-reschedule', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //11. Pickup Fail D
    //     Route::post('/pickup-fail', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //12. First Attempt Delivery Fail D
    //     Route::post('/firstattempt-deliveryfail', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //13. Returned sender D
    //     Route::post('/return-sender', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End

    // //14. Completed D
    //     Route::post('/completed', 'Api\Ninja\webhook\WebhookNinjaController@handledWebhook');
    // // End


});

