<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderNinjaTable extends Migration
{
    public function up()
    {
        Schema::create('order_ninja', function (Blueprint $table) {
            $table->id();
            $table->string('id_account');
            $table->string('requested_tracking_number');
            $table->string('tracking_number');
            $table->string('service_type');
            $table->string('service_level');
            $table->string('merchant_order_number');
            $table->string('from_name');
            $table->string('from_phone_number');
            $table->string('from_email');
            $table->string('from_address1');
            $table->string('from_address2');
            $table->string('from_area');
            $table->string('from_city');
            $table->string('from_state');
            $table->string('from_address_type');
            $table->string('from_country');
            $table->string('from_postcode');
            $table->string('to_name');
            $table->string('to_phone_number');
            $table->string('to_email');
            $table->string('to_address1');
            $table->string('to_address2');
            $table->string('to_area');
            $table->string('to_city');
            $table->string('to_state');
            $table->string('to_address_type');
            $table->string('to_country');
            $table->string('to_postcode');
            $table->boolean('is_pickup_required');
            $table->string('pickup_service_type');
            $table->string('pickup_service_level');
            $table->string('pickup_address_id');
            $table->date('pickup_date');
            $table->time('pickup_start_time');
            $table->time('pickup_end_time');
            $table->string('pickup_timezone');
            $table->string('pickup_approximate_volume');
            $table->text('pickup_instructions');
            $table->date('delivery_start_date');
            $table->time('delivery_start_time');
            $table->time('delivery_end_time');
            $table->string('delivery_timezone');
            $table->text('delivery_instructions');
            $table->boolean('allow_weekend_delivery');
            $table->decimal('weight', 8, 2);
            $table->text('item_description');
            $table->integer('quantity');
            $table->boolean('is_dangerous_good');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_ninja');
    }
}
