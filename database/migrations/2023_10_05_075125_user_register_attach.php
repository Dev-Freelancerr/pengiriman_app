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
        Schema::create('user_account_attach', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_account');
            $table->foreign('id_account')->references('id')->on('account_users');
            $table->string('origin_name');
            $table->string('file');
            $table->string('file_ext');
            $table->string('file_size');
            $table->enum('tipe', ['KTP', 'SKU', 'SIUP']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
