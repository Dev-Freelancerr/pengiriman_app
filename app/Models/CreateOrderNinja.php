<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateOrderNinja extends Model
{
    use HasFactory;
    protected $table = "order_ninja";

    protected $fillable = [
        'id_account',
        'requested_tracking_number',
        'tracking_number',
        'service_type',
        'service_level',
        'merchant_order_number',
        'from_city',
        'from_province',
        'from_name',
        'from_phone_number',
        'from_email',
        'from_address1',
        'from_address2',
        'from_kecamatan',
        'from_kelurahan',
        'from_address_type',
        'from_country',
        'from_postcode',
        'to_city',
        'to_province',
        'to_name',
        'to_phone_number',
        'to_email',
        'to_address1',
        'to_address2',
        'to_kecamatan',
        'to_kelurahan',
        'to_address_type',
        'to_country',
        'to_postcode',
        'seller_id',
        'is_pickup_required',
        'pickup_service_type',
        'pickup_service_level',
        'pickup_address_id',
        'pickup_date',
        'pickup_start_time',
        'pickup_end_time',
        'pickup_timezone',
        'pickup_approximate_volume',
        'pickup_instructions',
        'delivery_start_date',
        'delivery_start_time',
        'delivery_end_time',
        'delivery_timezone',
        'delivery_instructions',
        'allow_weekend_delivery',
        'weight',
        'item_description',
        'quantity',
        'is_dangerous_good',
        'tipe_penjemputan',
        'tipe_bayar',
        'harga',
        'transportasi_jemput',
        'seller_id',
        'remark_1',
        'remark_2',
        'size',
        'lebar',
        'panjang',
        'tinggi'
    ];
}
