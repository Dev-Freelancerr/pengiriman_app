<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPengiriman extends Model
{
    use HasFactory;

    protected $table = 'alamat_pengiriman';

    protected $fillable = [
        'id_account',
        'nama_toko',
        'nama_pic_pengiriman',
        'no_telp_pic',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'postal_code',
    ];
}
