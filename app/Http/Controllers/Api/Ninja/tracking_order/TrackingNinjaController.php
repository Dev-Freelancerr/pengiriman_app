<?php

namespace App\Http\Controllers\api\Ninja\tracking_order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrackingNinjaController extends Controller
{
    public function index() {
        return view("ninja.tracking.index");
    }

    public function search(Request $request) {

    }
}
