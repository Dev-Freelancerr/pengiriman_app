<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_account_raws extends Model
{
    use HasFactory;
    protected $table = "user_account_attach";
    protected $fillable = [
        'id_account',
        'origin_name',
        'file',
        'file_ext',
        'file_size',
        'tipe'
    ];
}
