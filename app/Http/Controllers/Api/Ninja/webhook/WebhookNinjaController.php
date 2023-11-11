<?php

namespace App\Http\Controllers\api\Ninja\webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WebhookNinjaController extends Controller
{
    private $clientSecret;

    public function __construct()
    {
        $this->clientSecret = env('NINJA_CLIENT_KEY');
    }
    private function verifyWebhook($data, $hmacHeader)
    {
        $calculatedHmac = base64_encode(hash_hmac('sha256', $data, "f359fce48292442b9174aeb78bfc5d52", true));

        return($hmacHeader == 'sha256=' . $calculatedHmac);
    }

    public function handlePendingPickup(Request $request)
    {
        $data = $request->getContent();
        $hmacHeader = "f2pTC52/IFaYs/ZXvGGGPn5nv8ZIsBekw1/6jGV2BMw=";


        if ($this->verifyWebhook($data, $hmacHeader)) {
            $data = $request->all();

            return response()->json(['message' => 'Webhook for Pending Pickup handled successfully']);

        } else {
            // Webhook verification failed
            return response()->json(['message' => 'Webhook verification failed'], 403);
        }

  }

  public function handleCancelled(Request $request)
  {
      try {
          $data = $request->getContent();
          $hmacHeader = "f2pTC52/IFaYs/ZXvGGGPn5nv8ZIsBekw1/6jGV2BMw=";


                      // Log header dan payload
            Log::info('Webhook Headers', ['headers' => $request->headers->all()]);
            Log::info('Webhook Payload', ['payload' => $data]);


          // Verifikasi webhook
          if ($this->verifyWebhook($data, $hmacHeader)) {
              // Logika untuk menangani webhook pembatalan
              $payload = $request->all();

              // ... your logic ...

              // Buat respons JSON (contoh: berhasil)
              $response = response()->json(['message' => 'Webhook for Cancelled handled successfully']);

              // Log respons
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
