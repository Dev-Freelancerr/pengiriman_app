<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTrackNinja extends Model
{
    use HasFactory;
    protected $table = "tracking_packages";
    protected $fillable = [
        'shipper_id',
        'status',
        'previous_status',
        'shipper_ref_no',
        'tracking_ref_no',
        'shipper_order_ref_no',
        'timestamp',
        'tracking_id',
        'id_webhook',
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
    ];
}
