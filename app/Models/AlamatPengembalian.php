<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPengembalian extends Model
{
    use HasFactory;

    protected $table = 'alamat_pengembalian';

    protected $fillable = [
        'id_account',
        'id_alamat_pengiriman',
        'nama_pic_pengembalian',
        'no_telp_pic',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'postal_code',
    ];

    // Definisi relasi dengan tabel alamat_pengiriman
    public function alamatPengiriman()
    {
        return $this->belongsTo(AlamatPengiriman::class, 'id_alamat_pengiriman');
    }
}
