<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_account as UserAccount;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\user_account_raws as UserAttach;

class UserAccountRegisterController extends Controller
{
    public function store_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'hp_number' => 'required|numeric',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'ktp' => 'required|file|mimes:jpg,jpeg,png',
        ]);
        $file = $request->file('ktp');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = [
            'id_user' => Auth::user()->id,
            'fullname' => $request->input('fullname'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'handphone_number' => $request->input('hp_number'),
            'email' => Auth::user()->email
        ];

        $originalName = $file->getClientOriginalName();
        $md5FileName = md5(time() . $originalName) . '.' . $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        $fileExtension = $file->getClientOriginalExtension();

        try {
            $qry = UserAccount::create($data);
            $cek_id_account = UserAccount::where('id_user', Auth::user()->id)->first();
            $file->storeAs('uploads/register/account', $md5FileName);
            $data_file = [
                'origin_name' => $originalName,
                'file' => $md5FileName,
                'file_size' => $fileSize,
                'file_ext' => $fileExtension,
                'tipe' => 'KTP',
                'id_account' => $cek_id_account->id
            ];
            $qry_ktp = UserAttach::create($data_file);

            $uptd = User::where('id', Auth::user()->id)->update([
                'is_completed' => 'pending'
            ]);

            return redirect('/');
        } catch (\Exception $e) {

            return response()->json(['errors' => $e], 400);
        }
    }


}
