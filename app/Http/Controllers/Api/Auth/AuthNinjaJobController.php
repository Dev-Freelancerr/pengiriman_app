<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\TokenAccess;
use Carbon\Carbon;
use TheSeer\Tokenizer\Token;
use Illuminate\Support\Facades\Artisan;
class AuthNinjaJobController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index(Request $request)
    {
        $currentToken = TokenAccess::first();
        $expiredAt = Carbon::parse($currentToken->expired_at);
        $currentTime = Carbon::now();
        $selisih = $currentTime->diff($expiredAt);
        $totalMinutes = $selisih->days * 24 * 60 + $selisih->h * 60 + $selisih->i;


        if ($totalMinutes <= 5) {
            Artisan::call('config:clear');
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

                return response()->json($responseData);
            } else {
                // Permintaan gagal, Anda dapat mengakses pesan kesalahan
                $errorResponse = $response->json();
                return response()->json($errorResponse, $response->status());
            }
        }
        else {
            return response()->json([
                'message' => 'Tidak eksekusi krn belum selisih 5 menit',
                'selisih' => $totalMinutes." Menit"
                ]);
        }

    }
}
