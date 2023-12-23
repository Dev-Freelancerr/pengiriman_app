<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tracking_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('shipper_id');
            $table->string('status');
            $table->string('shipper_ref_no');
            $table->string('tracking_ref_no');
            $table->string('shipper_order_ref_no');
            $table->timestamp('timestamp');
            $table->uuid('uuid');
            $table->string('previous_status');
            $table->string('tracking_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_packages');
    }
};
