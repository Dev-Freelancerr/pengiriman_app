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
        Schema::create('token_access', function (Blueprint $table) {
            $table->id();
            $table->string('access_token');
            $table->string('token_type');
            $table->integer('expired');
            $table->boolean('active');
            $table->timestamp('created_token');
            $table->timestamp('expired_at')->nullable(); // Kolom expired_at diubah menjadi nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_access');
    }
};
