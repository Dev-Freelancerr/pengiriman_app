<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlamatPengiriman as penjemputan;

class OrderNinjaController extends Controller
{
    public function index() {
        $penjemputan = penjemputan::all();
        return view('ninja.order.new', [
            'penjemputan' => $penjemputan
        ]);
    }
}
