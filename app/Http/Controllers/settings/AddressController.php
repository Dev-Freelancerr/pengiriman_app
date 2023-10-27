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
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();

        try {
            $data_penjemputan = [
                'nama_toko' => $request->input('nama_penjual'),
                'nama_pic_penjemputan' => $request->input('pic_penjemputan'),
                'no_telp_pic' => $request->input('telp_pic_penjemputan'),
                'alamat' => $request->input('alamat_penjemputan'),
                'provinsi' => $request->input('provinsi_penjemputan'),
                'kota' => $request->input('kotakab_penjemputan'),
                'kecamatan' => $request->input('kec_penjemputan'),
                'kelurahan' => $request->input('kel_penjemputan'),
                'postal_code' => $request->input('pos_penjemputan'),
                'id_account' => getAccount(Auth::user()->id)->id
            ];

            $save_penjemputan = Penjemputan::create($data_penjemputan);

            $data_pengiriman = [
                'nama_pic_pengembalian' => $request->input('pic_pengembalian'),
                'no_telp_pic' => $request->input('telp_pic_pengembalian'),
                'alamat' => $request->input('alamat_pengembalian'),
                'provinsi' => $request->input('prov_pengembalian'),
                'kota' => $request->input('kotakab_pengembalian'),
                'kecamatan' => $request->input('kec_pengembalian'),
                'kelurahan' => $request->input('kel_pengembalian'),
                'postal_code' => $request->input('pos_pengembalian'),
                'id_account' => getAccount(Auth::user()->id)->id,
                'id_alamat_penjemputan' => $save_penjemputan->id
            ];

            $save_pengembalian = Pengembalian::create($data_pengiriman);

            if ($save_penjemputan && $save_pengembalian) {
                // Commit the transaction if both saves were successful
                DB::commit();

                return response()->json(['success' => 'Data berhasil disimpan']);
            } else {
                // Rollback the transaction if any save failed
                DB::rollBack();
                return response()->json(['error' => 'Gagal menyimpan data']);
            }
        } catch (\Exception $e) {
            // Handle any exceptions and rollback the transaction
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {

        try {
            DB::beginTransaction();
            $delete2 = Pengembalian::where('id_alamat_penjemputan', $id)->delete();
            $delete1 = Penjemputan::where('id', $id)->delete();
            if ($delete1 && $delete2) {
                // Jika kedua penghapusan berhasil
                DB::commit();
                return response()->json(['success' => true]);
            } else {
                // Jika salah satu penghapusan gagal
                DB::rollBack();
                return response()->json(['success' => false, 'error' => 'Gagal menghapus data']);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan
            DB::rollBack();
            return response()->json(['success' => false, 'error' => 'Terjadi kesalahan saat menghapus alamat: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('settings.address.create');
    }

    public function edit($id)
    {
        $penjemputan = Penjemputan::where('id', $id)->first();
        $pengembalian = Pengembalian::where('id_alamat_penjemputan', $id)->first();
        return view('settings.address.edit', [
            'penjemputan' => $penjemputan,
            'pengembalian' => $pengembalian,
        ]);
    }

    public function update($id, Request $request)
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

        DB::beginTransaction();

        try {
            $data_penjemputan = [
                'nama_toko' => $request->input('nama_penjual'),
                'nama_pic_penjemputan' => $request->input('pic_penjemputan'),
                'no_telp_pic' => $request->input('telp_pic_penjemputan'),
                'alamat' => $request->input('alamat_penjemputan'),
                'provinsi' => $request->input('provinsi_penjemputan'),
                'kota' => $request->input('kotakab_penjemputan'),
                'kecamatan' => $request->input('kec_penjemputan'),
                'kelurahan' => $request->input('kel_penjemputan'),
                'postal_code' => $request->input('pos_penjemputan')
            ];

            $save_penjemputan = Penjemputan::where('id', $id)->update($data_penjemputan);

            $data_pengiriman = [
                'nama_pic_pengembalian' => $request->input('pic_pengembalian'),
                'no_telp_pic' => $request->input('telp_pic_pengembalian'),
                'alamat' => $request->input('alamat_pengembalian'),
                'provinsi' => $request->input('prov_pengembalian'),
                'kota' => $request->input('kotakab_pengembalian'),
                'kecamatan' => $request->input('kec_pengembalian'),
                'kelurahan' => $request->input('kel_pengembalian'),
                'postal_code' => $request->input('pos_pengembalian'),
                'id_account' => getAccount(Auth::user()->id)->id
            ];

            $save_pengembalian = Pengembalian::where('id_alamat_penjemputan', $id)->update($data_pengiriman);

            if ($save_penjemputan && $save_pengembalian) {
                // Commit the transaction if both saves were successful
                DB::commit();

                return response()->json(['success' => 'Data berhasil diubah']);
            } else {
                // Rollback the transaction if any save failed
                DB::rollBack();
                return response()->json(['error' => 'Gagal mengubah data']);
            }
        } catch (\Exception $e) {
            // Handle any exceptions and rollback the transaction
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
