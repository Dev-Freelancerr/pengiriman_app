<?php

use App\Models\User;
use App\Models\user_account as Account;

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
