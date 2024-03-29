<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\user_account as UserAccount;
use App\Models\User;
use App\Models\MstBank;
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
            'rekening_bank' => 'required|file|mimes:jpg,jpeg,png',
            'nomor_rekening' => 'required',
            'bank' => 'required',
            'atas_nama_bank' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = [
            'id_user' => Auth::user()->id,
            'fullname' => $request->input('fullname'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'handphone_number' => $request->input('hp_number'),
            'email' => Auth::user()->email,
            'nomor_rekening' => $request->input('nomor_rekening'),
            'atas_nama_rekening' => $request->input('atas_nama_bank'),
            'bank' => $request->input('bank'),
            'seller_id' => $this->generateRandomString(12),
        ];

        try {
            DB::beginTransaction();
            $qry = UserAccount::create($data);
            $cek_id_account = UserAccount::where('id_user', Auth::user()->id)->first();

            if ($request->hasFile('ktp')) {
                $file = $request->file('ktp');
                $originalName = $file->getClientOriginalName();
                $md5FileName = md5(time() . $originalName.'_ktp') . '.' . $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $fileExtension = $file->getClientOriginalExtension();
		//$file->storeAs('img/registrasi', $md5FileName);
            
                $file->move(public_path('img/registrasi'), $md5FileName);
                $data_file = [
                    'origin_name' => $originalName,
                    'file' => $md5FileName,
                    'file_size' => $fileSize,
                    'file_ext' => $fileExtension,
                    'tipe' => 'KTP',
                    'id_account' => $cek_id_account->id
                ];

                $qry_ktp = UserAttach::where('id', getAccount(Auth::user()->id)->id)->create($data_file);
            }

            // 2. Rekening Bank
            if ($request->hasFile('rekening_bank')) {

                $file = $request->file('rekening_bank');
                $originalName = $file->getClientOriginalName();
                $md5FileName = md5(time() . $originalName.'_rekening') . '.' . $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $fileExtension = $file->getClientOriginalExtension();
		$file->move(public_path('img/registrasi'), $md5FileName);
                
                $data_file = [
                    'origin_name' => $originalName,
                    'file' => $md5FileName,
                    'file_size' => $fileSize,
                    'file_ext' => $fileExtension,
                    'tipe' => 'rekening',
                    'id_account' => $cek_id_account->id
                ];
                $qry_rekening = UserAttach::where('id', getAccount(Auth::user()->id)->id)->create($data_file);
            }


            $uptd = User::where('id', Auth::user()->id)->update([
                'is_completed' => 'pending'
            ]);
	    DB::commit();
            
            return redirect('/');
        } catch (\Throwable $th) {
    	    DB::rollback();
            return response()->json(['errors' => $th->getMessage()], 400);
        }
    }
    
    public function generateRandomString($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
    	$string .= $characters[$randomIndex];
	}

	return $string;
    }
    
    public function update_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'hp_number' => 'required|numeric',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'nomor_rekening' => 'required',
            'bank' => 'required',
            'atas_nama_bank' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            DB::beginTransaction();
            // 1. KTP
            if ($request->hasFile('ktp')) {
                $delete_ktp = UserAttach::where('id_account', getAccount(Auth::user()->id)->id)->where('tipe', 'KTP')->delete();

                $file = $request->file('ktp');
                $originalName = $file->getClientOriginalName();
                $md5FileName = md5(time() . $originalName.'_ktp') . '.' . $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $fileExtension = $file->getClientOriginalExtension();
		//$file->store('public/register', $md5FileName);
                $file->move(public_path('img/registrasi'), $md5FileName);
                $data_file = [
                    'origin_name' => $originalName,
                    'file' => $md5FileName,
                    'file_size' => $fileSize,
                    'file_ext' => $fileExtension,
                    'tipe' => 'KTP',
                    'id_account' => getAccount(Auth::user()->id)->id
                ];

                $qry_ktp = UserAttach::where('id', getAccount(Auth::user()->id)->id)->create($data_file);
            }

            // 2. Rekening Bank
            if ($request->hasFile('rekening_bank')) {
                $delete_rekening = UserAttach::where('id_account', getAccount(Auth::user()->id)->id)->where('tipe', 'rekening')->delete();

                $file = $request->file('rekening_bank');
                $originalName = $file->getClientOriginalName();
                $md5FileName = md5(time() . $originalName.'_rekening') . '.' . $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $fileExtension = $file->getClientOriginalExtension();
		//$file->store('public/register', $md5FileName);
                $file->move(public_path('img/registrasi'), $md5FileName);
                $data_file = [
                    'origin_name' => $originalName,
                    'file' => $md5FileName,
                    'file_size' => $fileSize,
                    'file_ext' => $fileExtension,
                    'tipe' => 'rekening',
                    'id_account' => getAccount(Auth::user()->id)->id
                ];
                $qry_ktp = UserAttach::where('id', getAccount(Auth::user()->id)->id)->create($data_file);
            }

            $data = [
                'fullname' => $request->input('fullname'),
                'address' => $request->input('address'),
                'gender' => $request->input('gender'),
                'handphone_number' => $request->input('hp_number'),
                'nomor_rekening' => $request->input('nomor_rekening'),
                'atas_nama_rekening' => $request->input('atas_nama_bank'),
                'bank' => $request->input('bank'),
                'email' => Auth::user()->email,
                'approval_status' => 'pending'
            ];
            $qry = UserAccount::where('id', getAccount(Auth::user()->id)->id)->update($data);
            $uptd = User::where('id', Auth::user()->id)->update([
                'is_completed' => 'pending'
            ]);
            DB::commit();
            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['errors' => "ki"], 400);
        }
    }

    public function home()
    {
        $account = UserAccount::where('id_user', Auth::user()->id)->first();
        $bank = MstBank::all();

        if (getAccount(Auth::user()->id)) {
            $attach = UserAttach::where('id_account', getAccount(Auth::user()->id)->id)->get();

            return view('home', [
                'account' => $account,
                'bank' => $bank,
                'attach' => $attach,
            ]);
        } else {
            return view('home', [
                'account' => $account,
                'bank' => $bank,
            ]);
        }
    }
}
