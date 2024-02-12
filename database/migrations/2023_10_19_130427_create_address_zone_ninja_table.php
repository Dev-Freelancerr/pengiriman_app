<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressZoneNinjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_zone_ninja', function (Blueprint $table) {
            $table->id();
            $table->string('Provinsi', 25);
            $table->string('KotaKabupaten', 31);
            $table->string('Kecamatan', 31);
            $table->string('L1_tier_code', 12);
            $table->string('L2_tier_code', 12);
            $table->timestamps(); // Jika Anda ingin menyertakan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_zone_ninja');
    }
}
