<?php

namespace App\Http\Controllers\api\Ninja\webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\CreateOrderNinja as OrderNinja;
use App\Models\OrderTrackNinja as TrackNinja;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

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


    public function handledWebhookV2(Request $request)
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

                // Ambil data yang dibuthkan
                $tracking_id = $payload['tracking_id'] ?? null;
                $shipper_order_ref_no = $payload['shipper_order_ref_no'] ?? null;
                $timestamp = $payload['timestamp'] ?? null;
                $status = $payload['status'] ?? null;
                $rts_reason = $payload['rts_reason'] ?? null;

                $is_parcel_on_rts_leg = $payload['is_parcel_on_rts_leg'] ?? null;
                $state = $payload['picked_up_information']['state'] ?? null;
                $signatureUri = $payload['picked_up_information']['proof']['signature_uri'] ?? null;
                $imageUris = $payload['picked_up_information']['proof']['image_uris'] ?? null;
                $signedBy_name = $payload['picked_up_information']['proof']['signed_by']['name'] ?? null;
                $signedBy_contact = $payload['picked_up_information']['proof']['signed_by']['contact'] ?? null;
                $signedBy_relationship = $payload['picked_up_information']['proof']['signed_by']['relationship'] ?? null;
                $arrived_at_pudo_information = $payload['arrived_at_pudo_information']['state'] ?? null;

                $pickup_exception_state = $payload['pickup_exception']['state'] ?? null;
                $pickup_exception_failure_reason = $payload['pickup_exception']['failure_reason'] ?? null;
                $pickup_exception_is_liable = $payload['pickup_exception']['is_liable'] ?? null;
                $imageUris_exception = $payload['pickup_exception']['proof']['image_uris'] ?? null;
                $country = $payload['arrived_at_origin_hub_information']['country'] ?? null;
                $city = $payload['arrived_at_origin_hub_information']['city'] ?? null;
                $hub = $payload['arrived_at_origin_hub_information']['hub'] ?? null;

                $country_transit = $payload['arrived_at_transit_hub_information']['country'] ?? null;
                $city_transit = $payload['arrived_at_transit_hub_information']['city'] ?? null;
                $hub_transit = $payload['arrived_at_transit_hub_information']['hub'] ?? null;

                $country_destination = $payload['arrived_at_destination_hub_information']['country'] ?? null;
                $city_destination = $payload['arrived_at_destination_hub_information']['city'] ?? null;
                $hub_destination = $payload['arrived_at_destination_hub_information']['hub'] ?? null;

                $country_sorting = $payload['in_transit_to_next_sorting_hub_information']['country'] ?? null;
                $city_sorting = $payload['in_transit_to_next_sorting_hub_information']['city'] ?? null;
                $hub_sorting = $payload['in_transit_to_next_sorting_hub_information']['hub'] ?? null;

                $driver_contact = $payload['on_vehicle_information']['driver_contact'] ?? null;
                $allow_doorstep_dropoff = $payload['on_vehicle_information']['allow_doorstep_dropoff'] ?? null;
                $driver_name = $payload['on_vehicle_information']['driver_name'] ?? null;

                $arrived_at_pudo_information_state = $payload['arrived_at_pudo_information']['state'] ?? null;

                $delivery_information_state = $payload['delivery_information']['state'] ?? null;
                $delivery_information_left_in_safe_place = $payload['delivery_information']['left_in_safe_place'] ?? null;
                $delivery_information_signedBy_contact = $payload['delivery_information']['proof']['signed_by']['contact'] ?? null;
                $delivery_information_signedBy_name = $payload['delivery_information']['proof']['signed_by']['name'] ?? null;
                $delivery_information_signedBy_relationship = $payload['delivery_information']['proof']['signed_by']['relationship'] ?? null;

                $delivery_information_image_uris = $payload['delivery_information']['proof']['image_uris'] ?? null;


                $delivery_information_signature_uri = $payload['delivery_information']['proof']['signature_uri'] ?? null;

                $delivery_exception_state = $payload['delivery_exception']['state'] ?? null;
                $delivery_exception_failure_reason = $payload['delivery_exception']['failure_reason'] ?? null;
                $delivery_exception_is_liable = $payload['delivery_exception']['is_liable'] ?? null;
                $delivery_exception_image_uris = $payload['delivery_exception']['proof']['image_uris'] ?? null;
                $cancellation_information = $payload['cancellation_information']['reason'] ?? null;

                // $imageUrisString = implode(', ', $imageUris ?? $imageUris_exception ?? $delivery_information_image_uris ?? $delivery_exception_image_uris);
                    // Memeriksa apakah semua variabel null
                    if ($imageUris === null && $imageUris_exception === null && $delivery_information_image_uris === null && $delivery_exception_image_uris === null) {
                        $imageUrisString = null;
                    } else {
                        // Menggunakan implode dengan nilai default array kosong jika variabel adalah null
                        $imageUrisString = implode(', ', $imageUris ?? $imageUris_exception ?? $delivery_information_image_uris ?? $delivery_exception_image_uris);
                    }


                $data_order = [
                    'status' => $status,
                    'shipper_order_ref_no' => $shipper_order_ref_no,
                    'timestamp' => Carbon::parse($timestamp),
                    'tracking_id' => $tracking_id,
                    'is_parcel_on_rts_leg' => $is_parcel_on_rts_leg,
                    'driver_contact' => $driver_contact,
                    'allow_doorstep_dropoff' => $allow_doorstep_dropoff,
                    'driver_name' => $driver_name,
                    'left_in_safe_place' => $delivery_information_left_in_safe_place,
                    'reason_cancel' => $cancellation_information,
                    'reason' => $rts_reason,
                    'state' => $state ?? $pickup_exception_state ?? $arrived_at_pudo_information_state ?? $delivery_information_state ?? $delivery_exception_state,
                    'signature_uri' => $signatureUri ?? $delivery_information_signature_uri,
                    'image_uris' => $imageUrisString,
                    'signed_by_contact' => $signedBy_contact ?? $delivery_information_signedBy_contact,
                    'signed_by_name' => $signedBy_name ?? $delivery_information_signedBy_name,
                    'signed_by_relationship' => $signedBy_relationship ?? $delivery_information_signedBy_relationship,
                    'arrived_at_pudo_information_state' => $arrived_at_pudo_information,
                    'failure_reason' => $pickup_exception_failure_reason ?? $delivery_exception_failure_reason,
                    'is_liable' => $pickup_exception_is_liable ?? $delivery_exception_is_liable,
                    'country' => $country ?? $country_transit ?? $country_destination ?? $country_sorting,
                    'city' => $city ?? $city_transit ?? $city_destination ?? $city_sorting,
                    'hub' => $hub ?? $hub_transit ?? $hub_destination ?? $hub_sorting,

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
