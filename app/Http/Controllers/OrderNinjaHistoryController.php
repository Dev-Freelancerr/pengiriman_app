<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreateOrderNinja as OrderNinja;
use Auth;
class OrderNinjaHistoryController extends Controller
{
    public function index() {
        $data = OrderNinja::where('seller_id', getAccount(Auth::user()->id)->seller_id)->get();

        return view('ninja.order.history', [
            'order' => $data
        ]);
    }

    public function show($id) {
        $data = OrderNinja::where('seller_id', getAccount(Auth::user()->id)->seller_id)
            ->where('id', $id)
            ->first();

        return view('ninja.order.show', [
            'order' => $data
        ]);
    }
}
