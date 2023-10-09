<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index() {
        return view('settings.address.index');
    }

    public function create() {
        dd("a");
    }
}
