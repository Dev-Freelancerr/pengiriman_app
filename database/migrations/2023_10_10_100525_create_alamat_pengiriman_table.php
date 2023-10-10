<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatPengirimanTable extends Migration
{
    public function up()
    {
        Schema::create('alamat_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_account');
            $table->string('nama_toko');
            $table->string('nama_pic_pengiriman');
            $table->string('no_telp_pic');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alamat_pengiriman');
    }
}
