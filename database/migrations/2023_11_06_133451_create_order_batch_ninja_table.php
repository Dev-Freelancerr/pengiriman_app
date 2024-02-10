<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBatchNinjaTable extends Migration
{
    public function up()
    {
        Schema::create('order_batch_ninja', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id');
            $table->integer('jum_pesanan');
            $table->integer('jum_pending');
            $table->integer('jum_error');
            $table->boolean('belum_bayar')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_batch_ninja');
    }
}
