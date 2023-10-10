<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\subdistrict;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\PostalCode;


class AddressController extends Controller
{
    public function index() {
        return view('settings.address.index');
    }

    public function create() {
        dd("a");
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



}
