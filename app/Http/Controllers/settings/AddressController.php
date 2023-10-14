<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\subdistrict;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\PostalCode;
use App\Models\AlamatPengiriman as Penjemputan;
use App\Models\AlamatPengembalian as Pengembalian;
use Auth;


class AddressController extends Controller
{
    public function index() {
        $penjemputan = Penjemputan::all();
        return view('settings.address.index', [
            'penjemputan' => $penjemputan
        ]);
    }


    public function store(Request $request) {

        if($request->has('id')) {
            $hapus_pengembalian = Pengembalian::where('id_alamat_penjemputan', $request->input('id'))->delete();
            $hapus_penjemputan = Penjemputan::where('id', $request->input('id'))->delete();

            if($request->has('edit_alamat_jemput')) {
                $data_penjemputan = [
                    'id_account' => getAccount(Auth::user()->id)->id,
                    'nama_toko' => $request->input('nama_penjual'),
                    'nama_pic_penjemputan' => $request->input('pic_penjemputan'),
                    'no_telp_pic' => $request->input('telp_pic_penjemputan'),
                    'alamat' => $request->input('alamat_penjemputan'),
                    'provinsi' => $request->input('provinsi_penjemputan'),
                    'kota' => $request->input('kota_penjemputan'),
                    'kecamatan' => $request->input('kec_penjemputan'),
                    'kelurahan' => $request->input('kel_penjemputan'),
                    'postal_code' => $request->input('kec_penjemputan'),
                ];
            }
            else {
                $data_penjemputan = [
                    'id_account' => getAccount(Auth::user()->id)->id,
                    'nama_toko' => $request->input('nama_penjual'),
                    'nama_pic_penjemputan' => $request->input('pic_penjemputan'),
                    'no_telp_pic' => $request->input('telp_pic_penjemputan'),
                    'alamat' => $request->input('alamat_penjemputan'),
                    'provinsi' => $request->input('provinsi1'),
                    'kota' => $request->input('kota1'),
                    'kecamatan' => $request->input('kec1'),
                    'kelurahan' => $request->input('kel1'),
                    'postal_code' => $request->input('pos1'),
                ];
            }
            $save_penjemputan = Penjemputan::create ($data_penjemputan);
            $id_penjemputan = $save_penjemputan->id;
            if($request->has('edit_alamat_kembali')) {
                $data_pengembalian = [
                    'id_alamat_penjemputan' => $id_penjemputan,
                    'id_account' => getAccount(Auth::user()->id)->id,
                    'nama_pic_pengembalian' => $request->input('pic_pengembalian'),
                    'no_telp_pic' => $request->input('telp_pic_pengembalian'),
                    'alamat' => $request->input('alamat_pengembalian'),
                    'provinsi' => $request->input('provinsi_pengembalian'),
                    'kota' => $request->input('kota_pengembalian'),
                    'kecamatan' => $request->input('kecamatan_pengembalian'),
                    'kelurahan' => $request->input('kelurahan_pengembalian'),
                    'postal_code' => $request->input('pos_pengembalian'),
                ];
            }
            else {
                $data_pengembalian = [
                    'id_alamat_penjemputan' => $id_penjemputan,
                    'id_account' => getAccount(Auth::user()->id)->id,
                    'nama_pic_pengembalian' => $request->input('pic_pengembalian'),
                    'no_telp_pic' => $request->input('telp_pic_pengembalian'),
                    'alamat' => $request->input('alamat_pengembalian'),
                    'provinsi' => $request->input('provinsi2'),
                    'kota' => $request->input('kota2'),
                    'kecamatan' => $request->input('kec2'),
                    'kelurahan' => $request->input('kel2'),
                    'postal_code' => $request->input('pos2'),
                ];
            }
            $save_pengembalian = Pengembalian::create($data_pengembalian);
            return redirect('settings/address');

        }
        else {
            $data_penjemputan = [
                'id_account' => getAccount(Auth::user()->id)->id,
                'nama_toko' => $request->input('nama_penjual'),
                'nama_pic_penjemputan' => $request->input('pic_penjemputan'),
                'no_telp_pic' => $request->input('telp_pic_penjemputan'),
                'alamat' => $request->input('alamat_penjemputan'),
                'provinsi' => $request->input('provinsi_penjemputan'),
                'kota' => $request->input('kota_penjemputan'),
                'kecamatan' => $request->input('kec_penjemputan'),
                'kelurahan' => $request->input('kel_penjemputan'),
                'postal_code' => $request->input('kec_penjemputan'),
            ];
            $save_penjemputan = Penjemputan::create ($data_penjemputan);
            if($save_penjemputan) {
                $id_penjemputan = $save_penjemputan->id;
                if($request->has('copy_alamat')) {
                    $data_pengembalian = [
                        'id_alamat_penjemputan' => $id_penjemputan,
                        'id_account' => getAccount(Auth::user()->id)->id,
                        'nama_pic_pengembalian' => $request->input('pic_pengembalian_copy'),
                        'no_telp_pic' => $request->input('telp_pic_pengembalian_copy'),
                        'alamat' => $request->input('alamat_pengembalian_copy'),
                        'provinsi' => getProvinceName($request->input('prpvinsi_pengembalian_copy'))->prov_id,
                        'kota' => getCityName($request->input('kota_pengembalian_copy'))->city_id,
                        'kecamatan' => getDistrictName($request->input('kec_pengembalian_copy'))->dis_id,
                        'kelurahan' => getSubDistrictName($request->input('kel_pengembalian_copy'))->subdis_id,
                        'postal_code' => getPostCodeName($request->input('pos_pengembalian_copy'))->postal_id,
                    ];

                    $save_pengembalian = Pengembalian::create($data_pengembalian);
                }
                else {
                    $data_pengembalian = [
                        'id_alamat_penjemputan' => $id_penjemputan,
                        'id_account' => getAccount(Auth::user()->id)->id,
                        'nama_pic_pengembalian' => $request->input('pic_pengembalian'),
                        'no_telp_pic' => $request->input('telp_pic_pengembalian'),
                        'alamat' => $request->input('alamat_pengembalian'),
                        'provinsi' => $request->input('provinsi_pengembalian'),
                        'kota' => $request->input('kota_pengembalian'),
                        'kecamatan' => $request->input('kec_pengembalian'),
                        'kelurahan' => $request->input('kel_pengembalian'),
                        'postal_code' => $request->input('pos_pengembalian'),

                    ];

                    $save_pengembalian = Pengembalian::create($data_pengembalian);
                }
            }
            else {
                dd("GAGAL SAVE ");
            }
        }
        return redirect('settings/address');
    }

    public function destroy($id) {
        $delete2 = Pengembalian::where('id_alamat_penjemputan', $id)->delete();
        if($delete2) {
            $delete1 = Penjemputan::where('id', $id)->delete();
            if($delete1) {
                return response()->json(['success' => true]);
            }
        }
        else {
            return response()->json(['success' => false, 'error' => 'Gagal menghapus data']);
        }
    }

    public function ajax_province() {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function ajax_city($provinceId) {

        $city = City::where('prov_id', $provinceId)->get();
        return response()->json($city);
    }

    public function ajax_district($cityId) {

        $city = District::where('city_id', $cityId)->get();
        return response()->json($city);
    }

    public function ajax_subdistrict($districtId) {

        $city = subdistrict::where('dis_id', $districtId)->get();
        return response()->json($city);
    }

    public function ajax_postalcode($subdistrictId) {

        $city = PostalCode::where('subdis_id', $subdistrictId)->get();
        return response()->json($city);
    }


    public function ajax_pengembalian_province() {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function ajax_pengembalian_city($provinceId) {

        $city = City::where('prov_id', $provinceId)->get();
        return response()->json($city);
    }

    public function ajax_pengembalian_district($cityId) {

        $city = District::where('city_id', $cityId)->get();
        return response()->json($city);
    }

    public function ajax_pengembalian_subdistrict($districtId) {

        $city = subdistrict::where('dis_id', $districtId)->get();
        return response()->json($city);
    }

    public function ajax_pengembalian_postalcode($subdistrictId) {

        $city = PostalCode::where('subdis_id', $subdistrictId)->get();
        return response()->json($city);
    }

    public function edit($id) {
        $penjemputan = Penjemputan::where('id', $id)->first();
        $pengembalian = Pengembalian::where('id_alamat_penjemputan', $id)->first();
        $data = [
            'penjemputan' => $penjemputan,
            'pengembalian' => $pengembalian,
        ];

        return response()->json($data);
    }


}
