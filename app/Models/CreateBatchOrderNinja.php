<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateBatchOrderNinja extends Model
{
    use HasFactory;
    protected $table = "order_batch_ninja";

    protected $fillable = [
        'batch_id',
        'jum_pesanan',
        'jum_pending',
        'jum_error',
        'belum_bayar',
        'created_by',
        'seller_id'
    ];
}
