<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlamatPengiriman as penjemputan;
use App\Models\ZoneCodeAddressNinja as NinjaAddress;
use Illuminate\Support\Facades\Http;

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

    public function estimate_price($l1_jemput,$l2_jemput,$l1_kirim,$l2_kirim,$weight)
    {
        // Ambil data yang diperlukan dari variabel JavaScript/jQuery
        $l1_code_alamat_jemput = $l1_jemput;
        $l2_code_alamat_jemput = $l2_jemput;
        $l1_code_alamat_kirim = $l1_kirim;
        $l2_code_alamat_kirim = $l2_kirim;
        $berat = $weight;

        // Membentuk payload untuk permintaan POST
        $data = [
            'weight' => (double)$berat,
            'service_level' => 'Standard',
            'from' => [
                'l1_tier_code' => $l1_code_alamat_jemput,
                'l2_tier_code' => $l2_code_alamat_jemput,
            ],
            'to' => [
                'l1_tier_code' => $l1_code_alamat_kirim,
                'l2_tier_code' => $l2_code_alamat_kirim,
            ],
        ];

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->post(urlEstimatePriceNinja("id"), $data);

        if ($response->successful()) {
            $responseData = $response->json();
            return response()->json($responseData);
        } else {
            $errorResponse = $response->json();
            return response()->json($errorResponse, $response->status());
        }
    }
}
