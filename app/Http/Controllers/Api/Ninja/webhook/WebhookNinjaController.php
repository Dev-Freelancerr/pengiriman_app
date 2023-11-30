<?php

namespace App\Http\Controllers\api\Ninja\webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\CreateOrderNinja as OrderNinja;
use App\Models\OrderTrackNinja as TrackNinja;
use Carbon\Carbon;

class WebhookNinjaController extends Controller
{
    private $clientSecret;

    public function __construct()
    {
        $this->clientSecret = env('NINJA_CLIENT_KEY');
    }
    private function verifyWebhook($data, $hmacHeader)
    {
        $calculatedHmac = base64_encode(hash_hmac('sha256', $data, $this->clientSecret, true));

        return ($hmacHeader == $calculatedHmac);
    }


    public function handledWebhook(Request $request)
    {
        try {
            $data = $request->getContent();
            $hmacHeader = $request->header('x-ninjavan-hmac-sha256');

            // Log header dan payload
            Log::info('Webhook Headers', ['headers' => $request->headers->all()]);
            Log::info('Webhook Payload', ['payload' => $data]);


            // Verifikasi webhook
            if ($this->verifyWebhook($data, $hmacHeader)) {
                // Logika untuk menangani webhook pembatalan
                $payload = json_decode($request->getContent(), true);


                // Ambil data yang dibutuhkan
                $shipper_id = $payload['shipper_id'];
                $status = $payload['status'];
                $shipper_ref_no = $payload['shipper_ref_no'];
                $tracking_ref_no = $payload['tracking_ref_no'];
                $shipper_order_ref_no = $payload['shipper_order_ref_no'];
                $timestamp = $payload['timestamp'];
                $tracking_id = $payload['tracking_id'];
                $previous_status = $payload['previous_status'] ?? null;
                $id = $payload['id'];
                $comments = $payload['comments'] ?? null;

                $data_order = [
                    'shipper_id' => $shipper_id,
                    'status' => $status,
                    'previous_status' => $previous_status,
                    'shipper_ref_no' => $shipper_ref_no,
                    'tracking_ref_no' => $tracking_ref_no,
                    'shipper_order_ref_no' => $shipper_order_ref_no,
                    'timestamp' => Carbon::parse($timestamp),
                    'tracking_id' => $tracking_id,
                    'uuid' => $id,
                    'comments' => $comments

                ];

                TrackNinja::create($data_order);


                $response = response()->json(['message' => 'Webhook for Cancelled handled successfully']);
                Log::info('Webhook Response', ['response' => $response->getContent()]);

                // Kembalikan respons
                return $response;
            } else {
                // Webhook verification failed
                // Log respons
                Log::error('Webhook Verification Failed');

                return response()->json(['error' => 'Webhook verification failed'], 403);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan
            Log::error('Error handling webhook: ' . $e->getMessage());

            // Buat respons JSON (contoh: gagal)
            $errorResponse = response()->json(['error' => 'Webhook handling failed'], 500);

            // Log respons
            Log::error('Webhook Error Response', ['response' => $errorResponse->getContent()]);

            // Kembalikan respons
            return $errorResponse;
        }
    }


}
