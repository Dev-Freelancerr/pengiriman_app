<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlamatPengiriman as penjemputan;
use App\Models\ZoneCodeAddressNinja as NinjaAddress;

class OrderNinjaController extends Controller
{
    public function index()
    {
        $penjemputan = penjemputan::all();
        return view('ninja.order.new', [
            'penjemputan' => $penjemputan
        ]);
    }

    public function searchAlamat(Request $request)
    {
        $provinsi = $request->input('provinsi');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan');

        $result = NinjaAddress::where('Provinsi', $provinsi)
            ->where('KotaKabupaten', $kota)
            ->where('Kecamatan', $kecamatan)
            ->first();

        if ($result) {
            $response = [
                'L1_tier_code' => $result->L1_tier_code,
                'L2_tier_code' => $result->L2_tier_code,
            ];
        } else {
            $response = [
                'error' => 'Data tidak ditemukan',
            ];
        }

        return response()->json($response);
    }
}
