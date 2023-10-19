<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZoneCodeAddressNinja as NinjaAddress;

class EstimateTarifController extends Controller
{
    public function index() {
        return view('estimasi.tarif.ninja.index');
    }
    public function getAddress(Request $request) {
        $term = $request->input('term');
        $results = NinjaAddress::where('Provinsi', 'like', '%'.$term.'%')
            ->orWhere('KotaKabupaten', 'like', '%'.$term.'%')
            ->orWhere('Kecamatan', 'like', '%'.$term.'%')
            ->get();

        $suggestions = [];

        foreach ($results as $result) {
            $suggestion = $result->Provinsi . ', ' . $result->KotaKabupaten . ', ' . $result->Kecamatan;
            $suggestions[] = $suggestion;
        }

        return response()->json($suggestions);
    }

}
