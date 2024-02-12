<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToTrackingPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tracking_packages', function (Blueprint $table) {
            $table->text('previous_weight')->nullable();
            $table->text('new_weight')->nullable();
            $table->text('previous_measurements_width')->nullable();
            $table->text('previous_measurements_height')->nullable();
            $table->text('previous_measurements_length')->nullable();
            $table->text('previous_measurements_size')->nullable();
            $table->text('previous_measurements_volumetric_weight')->nullable();
            $table->text('previous_measurements_volumetric_measured_weight')->nullable();
            $table->text('new_measurements_width')->nullable();
            $table->text('new_measurements_height')->nullable();
            $table->text('new_measurements_length')->nullable();
            $table->text('new_measurements_size')->nullable();
            $table->text('new_measurements_volumetric_weight')->nullable();
            $table->text('new_measurements_volumetric_measured_weight')->nullable();
            $table->text('pod_type')->nullable();
            $table->text('pod_name')->nullable();
            $table->text('pod_identity_number')->nullable();
            $table->text('pod_contact')->nullable();
            $table->text('pod_uri')->nullable();
            $table->text('pod_left_in_safe_place')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracking_packages', function (Blueprint $table) {
            $table->dropColumn([
                'previous_weight',
                'new_weight',
                'previous_measurements_width',
                'previous_measurements_height',
                'previous_measurements_length',
                'previous_measurements_size',
                'previous_measurements_volumetric_weight',
                'previous_measurements_volumetric_measured_weight',
                'new_measurements_width',
                'new_measurements_height',
                'new_measurements_length',
                'new_measurements_size',
                'new_measurements_volumetric_weight',
                'new_measurements_volumetric_measured_weight',
                'pod_type',
                'pod_name',
                'pod_identity_number',
                'pod_contact',
                'pod_uri',
                'pod_left_in_safe_place',
            ]);
        });
    }
}
