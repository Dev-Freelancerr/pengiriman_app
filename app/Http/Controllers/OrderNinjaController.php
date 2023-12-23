<?php

namespace App\Http\Controllers;

use App\Models\TokenAccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AlamatPengiriman as penjemputan;
use App\Models\ZoneCodeAddressNinja as NinjaAddress;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Models\CreateOrderNinja as OrderNinja;
use App\Models\CreateBatchOrderNinja as BatchNinja;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
class OrderNinjaController extends Controller
{
    public function index()
    {
        $penjemputan = Penjemputan::where('id_account', getAccount(Auth::user()->id)->id)->get();
        return view('ninja.order.new', [
            'penjemputan' => $penjemputan
        ]);
    }

    public function form_export() {
        return view('ninja.order.export');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file'); // get file
            $path = 'D:/project/new/tmp_file'; // Sesuaikan dengan lokasi yang Anda inginkan
            $file->move($path, $file->getClientOriginalName());

            $originalName = $file->getClientOriginalName();
            // Anda dapat menggunakan $originalName sesuai kebutuhan Anda

            // Membuat reader untuk membaca file Excel
            $reader = ReaderEntityFactory::createReaderFromFile($path.'/'.$originalName);
            $reader->open($path.'/'.$originalName);
            // Iterasi melalui setiap sheet
            foreach ($reader->getSheetIterator() as $sheet) {
                // Jika nama sheet adalah 'Orders', baca isinya
                if ($sheet->getName() === 'Sheet 1') {
                    $this->readOrderSheet($sheet);
                }
            }

            // Menutup reader setelah selesai membaca
            $reader->close();
        }
    }

    public function readOrderSheet($sheet)
    {
        $data = [];
        //loop untuk setiap baris pada excel
        foreach ($sheet->getRowIterator() as $idx => $row) {
            if ($idx > 1) { // skip baris pertama excel (Judul)
                // Menggunakan toArray() untuk mengakses nilai kolom
                $rowData = $row->toArray();

                $data = [
                    'row_id'   => $rowData[0], // Ubah angka sesuai dengan indeks kolom yang diinginkan
                    'order_id' => $rowData[1], // Ubah angka sesuai dengan indeks kolom yang diinginkan
                ];


                // $customer = new Customer();// buat customer baru
                // $customer->fill($data);// isi customer dari data excel
                // $customer->save(); // simpan customer
            }
        }
        dd($data);
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
            dd("gagal");
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
        $pattern_track = $pattern = '/^[0-9]{11}$/';
        $desiredLength = 11;
        $randomString1 = $this->generateRandomString($pattern_track, $desiredLength);


        $nilai_estimasi = str_replace([",", "."], "", preg_replace("/[^\d,]/", "", $request->input('estimasi_biaya')));
        $estimasi = intval($nilai_estimasi / 100);

        // buat batch ID

        $batch_num = $this->generateRandomString($pattern, $desiredLength);
        $order_id = $this->generateRandomString($pattern, $desiredLength);
        $batch_save = [
            'batch_id' => $batch_num,
            'jum_pesanan' => 1,
            'jum_pending' => 0,
            'jum_error' => 0,
            'belum_bayar' => 1,
            'seller_id' => getAccount(Auth::user()->id)->seller_id,
            'created_by' => getAccount(Auth::user()->id)->id,
        ];


        $data = [
            'marketplace' => [
                'seller_id' => getAccount(Auth::user()->id)->seller_id,
                'seller_company_name' => getAccount(Auth::user()->id)->fullname,
            ],
            'service_type' => 'Marketplace',
            'service_level' => 'Standard',
            'requested_tracking_number' => $this->generateTrackingNumber(),
            // 'reference' => [
            //     'merchant_order_number' => 'TESTORDER00020'
            // ],
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
                    'country' => 'ID'
                ]
            ],
            'parcel_job' => [
                'is_pickup_required' => $barangDiJemput,
                'pickup_service_type' => 'Scheduled',
                'pickup_service_level' => 'Standard',
                'pickup_date' => $request->input('tgl_jemput'),
                'pickup_timeslot' => [
                    'start_time' => $jamAwalJemput,
                    'end_time' => $jamAkhirJemput,
                    'timezone' => 'Asia/Jakarta'
                ],
                //'cash_on_delivery' => doubleval($request->input('harga')),
                // 'insured_value' => doubleval($request->input('nilai_asuransi')),
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
        $tipeBayar = $request->input('tipe_bayar');
        $nilaiAsuransi = $request->input('nilai_asuransi');

        if ($tipeBayar == "Non - COD") {

            unset($data['parcel_job']['cash_on_delivery']);
        }
        else {

            $data['parcel_job']['cash_on_delivery'] = doubleval($request->input('harga'));
        }
        if($nilaiAsuransi === null) {
            unset($data['parcel_job']['insured_value']);
        }
        else {
             $data['parcel_job']['insured_value'] = doubleval($request->input('nilai_asuransi'));
        }

        $accessToken = getAccessToken();
        $maxRetryAttempts = 3;
        $retryAttempts = 1;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json'
        ];

        do {

            try {
                $response = Http::withHeaders($headers)
                    ->post(urlCreateOrder("SG"), $data);

                if ($response->successful()) {

                    $responseData = $response->json();
                    $dataSave = (object)$responseData;

                    $returnOrder = [
                        'id_account' => getAccount(Auth::user()->id)->id,
                        'requested_tracking_number' => $dataSave->tracking_number,
                        'tracking_number' => $dataSave->tracking_number,
                        'service_type' => $dataSave->service_type,
                        'service_level' => $dataSave->service_level,
                        'merchant_order_number' => isset($dataSave->reference['merchant_order_number']) ? $dataSave->reference['merchant_order_number'] : null,

                        'from_city' => $dataSave->from['address']['city'],
                        'from_province' => $dataSave->from['address']['province'],
                        'from_name' => $dataSave->from['name'],
                        'from_phone_number' => $dataSave->from['phone_number'],
                        'from_email' => isset($dataSave->from['email']) ? $dataSave->from['email'] : null,
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
                        'to_email' => isset($dataSave->to['email']) ? $dataSave->to['email'] : null,
                        'to_address1' => $dataSave->to['address']['address1'],
                        'to_address2' => $dataSave->to['address']['address2'],
                        'to_kecamatan' => $dataSave->to['address']['kecamatan'],
                        'to_kelurahan' => isset($dataSave->to['address']['kelurahan']) ? $dataSave->to['address']['kelurahan'] : null,

                        'to_address_type' => "Home",
                        'to_country' => $dataSave->to['address']['country'],
                        'to_postcode' => isset($dataSave->to['address']['postcode']) ? $dataSave->to['address']['postcode'] : null,


                        'seller_id' => $dataSave->marketplace['seller_id'],

                        'is_pickup_required' => $dataSave->parcel_job['is_pickup_required'],
                        'pickup_service_type' => $dataSave->parcel_job['pickup_service_type'],
                        'pickup_service_level' => $dataSave->parcel_job['pickup_service_level'],
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

                        'batch_id' => $batch_num,
                        'estimasi_biaya_kirim' => $estimasi - (($request->input('harga') * 0.03) * 0.11),
                        'jumlah_bersih' => $request->input('harga') - ($estimasi - ($request->input('harga') * 0.03 * 0.11)),
                        'nilai_diasuransikan' => $request->input('nilai_asuransi'),
                        'order_id' => $order_id,
                        'status' => 'Pending Pickup',
                        'previous_status' => '-'
                    ];


                    $batch_qry = BatchNinja::create($batch_save);

                    $qry = OrderNinja::create($returnOrder);

                    if ($qry) {
                        return redirect('/ninja/order/history');
                    }

                } elseif ($response->status() === 401) {

                    $this->generateAccessToken();
                    $accessToken = getAccessToken();
                    $headers = [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Accept' => 'application/json'
                    ];
                    $response = Http::withHeaders($headers)->post(urlCreateOrder("SG"), $data);

                } elseif ($response->status() >= 500 && $response->status() < 600) {
                    $this->retryAfterDelay();
                } else {
                    $errorResponse = $response->json();
                    return response()
                        ->json($errorResponse, $response->status())
                        ->header('Content-Type', 'application/json; charset=utf-8')
                        ->header('X-Content-Type-Options', 'nosniff');

                }
            } catch (\Exception $e) {
                // Tangani pengecualian umum di sini
                Log::error('Error: ' . $e->getMessage());
                dd($e);
                // Handle error response atau redirect sesuai kebutuhan
            }

            $retryAttempts++;
        } while ($retryAttempts < $maxRetryAttempts);
    }

    private function generateAccessToken()
    {
        $data = [
            'client_id' => env('NINJA_CLIENT_ID'),
            'client_secret' => env('NINJA_CLIENT_KEY'),
            'grant_type' => "client_credentials",
        ];


        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->post('https://api-sandbox.ninjavan.co/ID/2.0/oauth/access_token', $data);



        if ($response->successful()) {
            $responseData = $response->json();
            $waktuSaatIni = Carbon::now();
            $waktuGMT7 = $waktuSaatIni->timezone('Asia/Jakarta');
            $waktuBuatToken = $waktuGMT7->format('Y-m-d H:i:s');

            $expires_in = (int)$response["expires_in"];

            $waktu_expired_token = $waktuGMT7->addSeconds((int)$response["expires_in"])->subMinutes(10)->toDateTimeString();

            $response_json = [
                'access_token' => $response["access_token"],
                'token_type' => $response["token_type"],
                'expired' => $response["expires_in"],
                'active' => $response["oauthClient"]['active'],
                'created_token' => $waktuBuatToken,
                'expired_at' => $waktu_expired_token
            ];
            $cek = TokenAccess::count();
            if ($cek > 0) {
                $hapus = TokenAccess::truncate();
            }
            $token = TokenAccess::create($response_json);
        }
    }


    private function retryAfterDelay()
    {
        sleep(5);
    }

    function generateTrackingNumber() {
        $length = 9; // Panjang minimal yang diinginkan
        $pattern = '/^([a-zA-Z0-9]+[-])*[a-zA-Z0-9]+$/';

        do {
            $trackingNumber = Str::random($length);
        } while (!preg_match($pattern, $trackingNumber));

        return $trackingNumber;
    }

    public function generateRandomString($pattern, $length)
    {
        $characters = '0123456789';
        $randomString = '';

        while (strlen($randomString) < $length) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        if (preg_match($pattern, $randomString) && strlen($randomString) >= 9) {
            return $randomString;
        } else {
            return $this->generateRandomString($pattern, $length);
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
            'weight' => (double)$berat,
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
