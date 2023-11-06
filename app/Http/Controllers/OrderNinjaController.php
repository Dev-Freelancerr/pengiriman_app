<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlamatPengiriman as penjemputan;
use App\Models\ZoneCodeAddressNinja as NinjaAddress;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\CreateOrderNinja as OrderNinja;

class OrderNinjaController extends Controller
{
    public function index()
    {
        $penjemputan = penjemputan::all();
        return view('ninja.order.new', [
            'penjemputan' => $penjemputan
        ]);
    }


    public function store(Request $request)
    {
        $rules = [
            'jadwal_jemput' => 'required|string',
            'alamat_jemput' => 'required|string',
            'tgl_jemput' => 'required|date',
            'jam_jemput' => 'required|string',
            'instruksi_driver' => 'required|string',
            'kendaraan_jemput' => 'required|string',
            'cust_name' => 'required|string',
            'jam_kirim' => 'required|string',
            'address' => 'required|string',
            'alamat_kirim' => 'required|string',
            'product_name' => 'required|string',
            'tipe_bayar' => 'required|string',
            'harga' => 'required|numeric',
        ];

        $customMessages = [
            'required' => 'Kolom :attribute harus diisi.',
            'date' => 'Kolom :attribute harus berformat tanggal yang valid.',
            'numeric' => 'Kolom :attribute harus berisi angka.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $alamatJemput = $request->input('alamat_jemput');
        $alamatParts = explode('-', $alamatJemput);
        $provinsiPenjemputan = $alamatParts[0];
        $kotaPenjemputan = $alamatParts[1];
        $kecamatanPenjemputan = $alamatParts[2];

        $alamatKirim = $request->input('alamat_kirim');
        $alamatPartsKirim = explode(',', $alamatKirim);
        $provinsiKirim = $alamatPartsKirim[0];
        $kotaKirim = $alamatPartsKirim[1];
        $kecamatanKirim = $alamatPartsKirim[2];

        $jamJemput = $request->input('jam_jemput');
        $jamJemputParts = explode(' - ', $jamJemput);
        $jamAwalJemput = $jamJemputParts[0];
        $jamAkhirJemput = $jamJemputParts[1];

        $jamKirim = $request->input('jam_kirim');
        $jamKirimParts = explode(' - ', $jamKirim);
        $jamAwalKirim = $jamKirimParts[0];
        $jamAkhirKirim = $jamKirimParts[1];

        if ($request->input('jadwal_jemput') == 'penjemputan-terjadwal') {
            $barangDiJemput = true;
        } else {
            $barangDiJemput = false;
        }
        $detailAlamatJemput = penjemputan::where('id', $request->input('alamat_jemput_id'))->first();


        $from_address = penjemputan::where('id_account', getAccount(Auth::user()->id)->id)->first();
        $pattern = '/^([a-zA-Z0-9]+[-])*[a-zA-Z0-9]+$/';
        $desiredLength = 12;
        $randomString1 = $this->generateRandomString($pattern, $desiredLength);


        $data = [
            'marketplace' => [
                'seller_id' => getAccount(Auth::user()->id)->seller_id,
                'seller_company_name' => 'BAN - Bintang Alifa Nusantara (Bandung) (Soscom)'
            ],
            'service_type' => 'Marketplace',
            'service_level' => 'Standard',
            'requested_tracking_number' => 'DPBAN' . $randomString1,
            'reference' => [
                'merchant_order_number' => 'TESTORDER00020'
            ],
            'from' => [
                'name' => $detailAlamatJemput->nama_toko,
                'phone_number' => $detailAlamatJemput->no_telp_pic,
                'email' => '-',
                'address' => [
                    'address1' => $detailAlamatJemput->alamat,
                    'address2' => '-',
                    'kelurahan' => $detailAlamatJemput->kelurahan,
                    'kecamatan' => $kecamatanPenjemputan,
                    'city' => $kotaPenjemputan,
                    'province' => $provinsiPenjemputan,
                    'postcode' => $detailAlamatJemput->postal_code,
                    'address_type' => 'home',
                    'country' => 'ID',
                    'latitude' => '',
                    'longitude' => '',
                ]
            ],
            'to' => [
                'name' => $request->input('cust_name'),
                'phone_number' => $request->input('cust_contact'),
                'email' => $request->input('cust_email'),
                'address' => [
                    'address1' => $request->input('address'),
                    'address2' => $request->input('address2'),
                    'kelurahan' => $request->input('kelurahan'),
                    'kecamatan' => $kecamatanKirim,
                    'city' => $kotaKirim,
                    'province' => $provinsiKirim,
                    'postcode' => $request->input('postalcode'),
                    'address_type' => 'home',
                    'country' => 'ID',
                    'latitude' => '',
                    'longitude' => '',
                ]
            ],
            'parcel_job' => [
                'is_pickup_required' => $barangDiJemput,
                'pickup_address_id' => '98989012',
                'pickup_service_type' => 'Scheduled',
                'pickup_service_level' => 'Standard',
                'pickup_date' => $request->input('tgl_jemput'),
                'pickup_timeslot' => [
                    'start_time' => $jamAwalJemput,
                    'end_time' => $jamAkhirJemput,
                    'timezone' => 'Asia/Jakarta'
                ],
                'cash_on_delivery' => doubleval($request->input('harga')),
                'insured_value' => doubleval($request->input('harga')),
                'pickup_instructions' => $request->input('instruksi_driver'),
                'delivery_instructions' => $request->input('delivery_instruction'),
                'delivery_start_date' => $request->input('tgl_kirim'),
                'delivery_timeslot' => [
                    'start_time' => $jamAwalKirim,
                    'end_time' => $jamAkhirKirim,
                    'timezone' => 'Asia/Jakarta'
                ],
                'dimensions' => [
                    'weight' => $request->input('berat')
                ],
                'items' => [
                    [
                        'item_description' => $request->input('product_name'),
                        'quantity' => $request->input('qty'),
                        'is_dangerous_good' => $request->input('barang_berbahaya') == 'Y' ? true : false,
                    ]
                ]
            ]
        ];
        $accessToken = getAccessToken();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json'
        ];

        $response = Http::withHeaders($headers)
            ->post(urlCreateOrder("SG"), $data);

        if ($response->successful()) {
            $responseData = $response->json();
            $dataSave = (object) $responseData;

            $returnOrder = [
                'id_account' => getAccount(Auth::user()->id)->id,
                'requested_tracking_number' => $dataSave->requested_tracking_number,
                'tracking_number' => $dataSave->tracking_number,
                'service_type' => $dataSave->service_type,
                'service_level' => $dataSave->service_level,
                'merchant_order_number' => $dataSave->reference['merchant_order_number'],

                'from_city' => $dataSave->from['address']['city'],
                'from_province' => $dataSave->from['address']['province'],
                'from_name' => $dataSave->from['name'],
                'from_phone_number' => $dataSave->from['phone_number'],
                'from_email' => $dataSave->from['email'],
                'from_address1' => $dataSave->from['address']['address1'],
                'from_address2' => $dataSave->from['address']['address2'],
                'from_kecamatan' => $dataSave->from['address']['kecamatan'],
                'from_kelurahan' => $dataSave->from['address']['kelurahan'],
                'from_address_type' => "Home",
                'from_country' => $dataSave->from['address']['country'],
                'from_postcode' => $dataSave->from['address']['postcode'],

                'to_city' => $dataSave->to['address']['city'],
                'to_province' => $dataSave->to['address']['province'],
                'to_name' => $dataSave->to['name'],
                'to_phone_number' => $dataSave->to['phone_number'],
                'to_email' => $dataSave->to['email'],
                'to_address1' => $dataSave->to['address']['address1'],
                'to_address2' => $dataSave->to['address']['address2'],
                'to_kecamatan' => $dataSave->to['address']['kecamatan'],
                'to_kelurahan' => $dataSave->to['address']['kelurahan'],
                'to_address_type' => "Home",
                'to_country' => $dataSave->to['address']['country'],
                'to_postcode' => $dataSave->to['address']['postcode'],

                'seller_id' => $dataSave->marketplace['seller_id'],

                'is_pickup_required' => $dataSave->parcel_job['is_pickup_required'],
                'pickup_service_type' => $dataSave->parcel_job['pickup_service_type'],
                'pickup_service_level' => $dataSave->parcel_job['pickup_service_level'],
                'pickup_address_id' => $dataSave->parcel_job['pickup_address_id'],
                'pickup_date' => $dataSave->parcel_job['pickup_date'],
                'pickup_start_time' => $dataSave->parcel_job['pickup_timeslot']['start_time'],
                'pickup_end_time' => $dataSave->parcel_job['pickup_timeslot']['start_time'],
                'pickup_timezone' => $dataSave->parcel_job['pickup_timeslot']['timezone'],
                'pickup_approximate_volume' => $dataSave->parcel_job['pickup_approximate_volume'],
                'pickup_instructions' => $dataSave->parcel_job['pickup_instructions'],

                'delivery_start_date' => $dataSave->parcel_job['delivery_start_date'],
                'delivery_start_time' => $dataSave->parcel_job['delivery_timeslot']['start_time'],
                'delivery_end_time' => $dataSave->parcel_job['delivery_timeslot']['end_time'],
                'delivery_timezone' => $dataSave->parcel_job['delivery_timeslot']['timezone'],
                'delivery_instructions' => $dataSave->parcel_job['delivery_instructions'],

                'allow_weekend_delivery' => $dataSave->parcel_job['allow_weekend_delivery'],
                'weight' => $dataSave->parcel_job['dimensions']['weight'],
                'item_description' => $request->input('product_name'),
                'quantity' => $request->input('qty'),
                'is_dangerous_good' => $request->input('barang_berbahaya') == 'Y' ? true : false,
                'tipe_penjemputan' => $request->input('jadwal_jemput'),
                'tipe_bayar' => $request->input('tipe_bayar'),
                'harga' => $request->input('harga'),
                'transportasi_jemput' => $request->input('kendaraan_jemput'),
                'remark_1' => $request->input('remark1'),
                'remark_2' => $request->input('remark2'),


            ];

            $qry = OrderNinja::create($returnOrder);
            if ($qry) {
                $successRespon = $response->json();
                return response()
                    ->json($successRespon, $response->status())
                    ->header('Content-Type', 'application/json; charset=utf-8')
                    ->header('X-Content-Type-Options', 'nosniff');
                return redirect('/');

            }

        } else {
            $errorResponse = $response->json();
            return response()
                ->json($errorResponse, $response->status())
                ->header('Content-Type', 'application/json; charset=utf-8')
                ->header('X-Content-Type-Options', 'nosniff');

        }
        dd($data);

        dd(getAccessToken());
    }

    public function generateRandomString($pattern, $length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-';
        $randomString = '';

        while (strlen($randomString) < $length) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        if (preg_match($pattern, $randomString) && strlen($randomString) >= 9) {
            return $randomString;
        } else {
            return generateRandomString($pattern, $length);
        }
    }


    public function searchAlamat(Request $request)
    {
        $provinsi = $request->input('provinsi');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan');

        $result = NinjaAddress::where('Provinsi', $provinsi)
            ->where('KotaKabupaten', $kota)
            ->where('Kecamatan', $kecamatan)
            ->first();

        if ($result) {
            $response = [
                'L1_tier_code' => $result->L1_tier_code,
                'L2_tier_code' => $result->L2_tier_code,
            ];
        } else {
            $response = [
                'error' => 'Data tidak ditemukan',
            ];
        }

        return response()->json($response);
    }

    public function estimate_price($l1_jemput, $l2_jemput, $l1_kirim, $l2_kirim, $weight)
    {

        // Ambil data yang diperlukan dari variabel JavaScript/jQuery
        $l1_code_alamat_jemput = $l1_jemput;
        $l2_code_alamat_jemput = $l2_jemput;
        $l1_code_alamat_kirim = $l1_kirim;
        $l2_code_alamat_kirim = $l2_kirim;
        $berat = $weight;

        // Membentuk payload untuk permintaan POST
        $data = [
            'weight' => (double) $berat,
            'service_level' => 'Standard',
            'from' => [
                'l1_tier_code' => $l1_code_alamat_jemput,
                'l2_tier_code' => $l2_code_alamat_jemput,
            ],
            'to' => [
                'l1_tier_code' => $l1_code_alamat_kirim,
                'l2_tier_code' => $l2_code_alamat_kirim,
            ],
        ];

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->post(urlEstimatePriceNinja("id"), $data);

        if ($response->successful()) {
            $responseData = $response->json();
            return response()->json($responseData);
        } else {
            $errorResponse = $response->json();
            return response()->json($errorResponse, $response->status());
        }
    }
}
