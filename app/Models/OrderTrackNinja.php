<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTrackNinja extends Model
{
    use HasFactory;
    protected $table = "tracking_packages";
    protected $guarded = [];
}
