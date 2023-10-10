<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatPengembalianTable extends Migration
{
    public function up()
    {
        Schema::create('alamat_pengembalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_account');
            $table->unsignedBigInteger('id_alamat_pengiriman');
            $table->string('nama_pic_pengembalian');
            $table->string('no_telp_pic');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('postal_code');
            $table->timestamps();

            // Menambahkan foreign key constraint ke tabel alamat_pengiriman
            $table->foreign('id_alamat_pengiriman')->references('id')->on('alamat_pengiriman');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alamat_pengembalian');
    }
}
