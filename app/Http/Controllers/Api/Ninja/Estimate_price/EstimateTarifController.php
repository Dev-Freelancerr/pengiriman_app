<?php

namespace App\Http\Controllers\Api\Ninja\Estimate_price;

use App\Http\Controllers\Controller;
use App\Models\ZoneCodeAddressNinja as NinjaAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EstimateTarifController extends Controller
{
    public function index()
    {
        return view('estimasi.tarif.ninja.index');
    }

    public function getAddress(Request $request)
    {
        $term = $request->input('term');

        // Query database Anda untuk mencari saran sesuai dengan $term
        $results = NinjaAddress::where('Provinsi', 'like', '%' . $term . '%')
            ->orWhere('KotaKabupaten', 'like', '%' . $term . '%')
            ->orWhere('Kecamatan', 'like', '%' . $term . '%')
            ->get();

        // Format hasil saran sebagai array JSON
        $suggestions = [];

        foreach ($results as $result) {
            $suggestion = [
                'value' => $result->Provinsi . ', ' . $result->KotaKabupaten . ', ' . $result->Kecamatan,
                'L1_TIER_CODE' => $result->L1_tier_code,
                'L2_TIER_CODE' => $result->L2_tier_code
            ];

            $suggestions[] = $suggestion;
        }

        return response()->json($suggestions);
//        $term = $request->input('term');
//        $results = NinjaAddress::where('Provinsi', 'like', '%'.$term.'%')
//            ->orWhere('KotaKabupaten', 'like', '%'.$term.'%')
//            ->orWhere('Kecamatan', 'like', '%'.$term.'%')
//            ->get();
//
//        $suggestions = [];
//
//        foreach ($results as $result) {
//            $suggestion = $result->Provinsi . ', ' . $result->KotaKabupaten . ', ' . $result->Kecamatan;
//            $suggestions[] = $suggestion;
//        }
//
//        return response()->json($suggestions);
    }

    public function search(Request $request)
    {
        $penjemputan = $request->input('penjemputan');
        $penjemputanArray = explode(',', $penjemputan);
        $provinsi_penjemputan = trim($penjemputanArray[0]);
        $kotakab_penjemputan = trim($penjemputanArray[1]);
        $kec_penjemputan = trim($penjemputanArray[2]);

        $pengiriman = $request->input('pengiriman');
        $pengirimanArray = explode(',', $pengiriman);
        $provinsi_pengiriman = trim($pengirimanArray[0]);
        $kotakab_pengiriman = trim($pengirimanArray[1]);
        $kec_pengiriman = trim($pengirimanArray[2]);

        $penjemputan_code = NinjaAddress::where([
            'Provinsi' => $provinsi_penjemputan,
            'KotaKabupaten' => $kotakab_penjemputan,
            'Kecamatan' => $kec_penjemputan
        ])->first();

        $pengiriman_code = NinjaAddress::where([
            'Provinsi' => $provinsi_pengiriman,
            'KotaKabupaten' => $kotakab_pengiriman,
            'Kecamatan' => $kec_pengiriman
        ])->first();

        $data = [
            'weight' => (double) $request->input('berat'),
            'service_level' => $request->input('layanan'),
            'from' => [
                'l1_tier_code' => $penjemputan_code->L1_tier_code,
                'l2_tier_code' => $penjemputan_code->L2_tier_code,
            ],
            'to' => [
                'l1_tier_code' => $pengiriman_code->L1_tier_code,
                'l2_tier_code' => $pengiriman_code->L2_tier_code,
            ],
        ];

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->post(urlEstimatePriceNinja("id"), $data);

        if($response->successful()) {
            $responseData = $response->json();
            return response()->json($responseData);
        }
        else {
            $errorResponse = $response->json();
            return response()->json($errorResponse, $response->status());
        }

    }

}
