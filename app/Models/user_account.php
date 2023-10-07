<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_account extends Model
{
    use HasFactory;

    protected $table = "account_users";
    protected $fillable = [
        'id_user',
        'fullname',
        'gender',
        'address',
        'email',
        'handphone_number',
        'nomor_rekening',
        'atas_nama_rekening',
        'bank'
    ];
}
