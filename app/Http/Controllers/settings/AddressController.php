<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\subdistrict;
use App\Models\ZoneCodeAddressNinja as NinjaAddress;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\PostalCode;
use App\Models\AlamatPengiriman as Penjemputan;
use App\Models\AlamatPengembalian as Pengembalian;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AddressController extends Controller
{
    public function index()
    {

        $penjemputan = Penjemputan::all();
        return view('settings.address.index', [
            'penjemputan' => $penjemputan
        ]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'nama_penjual' => 'required|string',
            'pic_penjemputan' => 'required|string',
            'telp_pic_penjemputan' => 'nullable|numeric',
            'alamat_penjemputan' => 'required|string',
            'provinsi_penjemputan' => 'required|string',
            'kotakab_penjemputan' => 'required|string',
            'kec_penjemputan' => 'required|string',
            'kel_penjemputan' => 'nullable|string',
            'pos_penjemputan' => 'nullable|numeric',

            'pic_pengembalian' => 'required|string',
            'telp_pic_pengembalian' => 'nullable|numeric',
            'alamat_pengembalian' => 'required|string',
            'prov_pengembalian' => 'required|string',
            'kotakab_pengembalian' => 'required|string',
            'kec_pengembalian' => 'required|string',
            'kel_pengembalian' => 'nullable|string',
            'pos_pengembalian' => 'nullable|numeric',
        ]);

        $validator->setAttributeNames([
            'nama_penjual' => 'Nama Penjual',
            'pic_penjemputan' => 'PIC Penjemputan',
            'telp_pic_penjemputan' => 'Telp PIC Penjemputan',
            'alamat_penjemputan' => 'Alamat Penjemputan',
            'provinsi_penjemputan' => 'Provinsi Penjemputan',
            'kotakab_penjemputan' => 'Kota/Kabupaten Penjemputan',
            'kec_penjemputan' => 'Kecamatan Penjemputan',
            'kel_penjemputan' => 'Kelurahan Penjemputan',
            'pos_penjemputan' => 'Kode Pos Penjemputan',
            'pic_pengembalian' => 'PIC Pengembalian',
            'telp_pic_pengembalian' => 'Telp PIC Pengembalian',
            'alamat_pengembalian' => 'Alamat Pengembalian',
            'prov_pengembalian' => 'Provinsi Pengembalian',
            'kotakab_pengembalian' => 'Kota/Kabupaten Pengembalian',
            'kec_pengembalian' => 'Kecamatan Pengembalian',
            'kel_pengembalian' => 'Kelurahan Pengembalian',
            'pos_pengembalian' => 'Kode Pos Pengembalian',
        ], [
            'telp_pic_penjemputan.numeric' => 'Telp PIC Penjemputan harus berisi angka.',
            'telp_pic_pengembalian.numeric' => 'Telp PIC Pengembalian harus berisi angka.',
            'pos_penjemputan.numeric' => 'Kode Pos Penjemputan harus berisi angka.',
            'pos_pengembalian.numeric' => 'Kode Pos Pengembalian harus berisi angka.',
        ]);

        if ($validator->fails()) {
            return view('settings.address.create')->withErrors($validator);
        }
        return response()->json(['success' => 'Data berhasil disimpan']);

    }

    public function destroy($id)
    {
        $delete2 = Pengembalian::where('id_alamat_penjemputan', $id)->delete();
        if ($delete2) {
            $delete1 = Penjemputan::where('id', $id)->delete();
            if ($delete1) {
                return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Gagal menghapus data']);
        }
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
    }

    public function create()
    {
        return view('settings.address.create');
    }

    public function edit($id)
    {
        $penjemputan = Penjemputan::where('id', $id)->first();
        $pengembalian = Pengembalian::where('id_alamat_penjemputan', $id)->first();
        $data = [
            'penjemputan' => $penjemputan,
            'pengembalian' => $pengembalian,
        ];

        return response()->json($data);
    }


}
