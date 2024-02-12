<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenAccess extends Model
{
    use HasFactory;
    protected $table = 'token_access';

    protected $fillable = [
        'access_token',
        'token_type',
        'expired',
        'active',
        'created_token',
        'expired_at',
    ];
}
