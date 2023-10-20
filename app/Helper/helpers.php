<?php

use App\Models\User;
use App\Models\user_account as Account;
use App\Models\District;
use App\Models\subdistrict;
use App\Models\Province;
use App\Models\City;
use App\Models\PostalCode;

if (!function_exists('getStatusUser')) {
    function getStatusUser($id)
    {
        $qry = User::where('id', $id)->first();
        return $qry->is_completed;
    }
}

if (!function_exists('getAccount')) {
    function getAccount($id)
    {
        $qry = Account::where('id_user', $id)->first();
        return $qry;
    }
}

if (!function_exists('getProvince')) {
    function getProvince($id)
    {
        $qry = Province::where('prov_id', $id)->first();
        return $qry;
    }
}

if (!function_exists('getProvinceName')) {
    function getProvinceName($id)
    {
        $qry = Province::where('prov_name', $id)->first();
        return $qry;
    }
}

if (!function_exists('getCity')) {
    function getCity($id)
    {
        $qry = City::where('city_id', $id)->first();
        return $qry;
    }
}

if (!function_exists('getCityName')) {
    function getCityName($id)
    {
        $qry = City::where('city_name', $id)->first();
        return $qry;
    }
}

if (!function_exists('getDistrict')) {
    function getDistrict($id)
    {
        $qry = District::where('dis_id', $id)->first();
        return $qry;
    }
}

if (!function_exists('getSubDistrict')) {
    function getSubDistrict($id)
    {
        $qry = subdistrict::where('subdis_id', $id)->first();
        return $qry;
    }
}

if (!function_exists('getPostCode')) {
    function getPostCode($id)
    {
        $qry = PostalCode::where('postal_id', $id)->first();
        return $qry;
    }
}

if (!function_exists('getDistrictName')) {
    function getDistrictName($id)
    {
        $qry = District::where('dis_name', $id)->first();
        return $qry;
    }
}

if (!function_exists('getSubDistrictName')) {
    function getSubDistrictName($id)
    {
        $qry = subdistrict::where('subdis_name', $id)->first();
        return $qry;
    }
}

if (!function_exists('getPostCodeName')) {
    function getPostCodeName($id)
    {
        $qry = PostalCode::where('postal_code', $id)->first();
        return $qry;
    }
}

// URL API ENDPOINT NINJA
// 1. Estimate price

if (!function_exists('urlEstimatePriceNinja')) {
    function urlEstimatePriceNinja($country_code)
    {
        return "https://api.ninjavan.co/".$country_code."/1.0/public/price";
    }
}


