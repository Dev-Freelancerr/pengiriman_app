<?php

namespace App\Http\Controllers\Api\Ninja\print_waybill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreateOrderNinja as OrderNinja;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class WaybillController extends Controller
{
    public function index(Request $request, $id)
    {
        $order = OrderNinja::where("id", $id)->first();
        return view("ninja.print.index", compact("order"));
    }

    public function print(Request $request)
    {
        $tracking_number = $request->input("tracking_number");
        $rules = $request->input("rules_print");


        $accessToken = getAccessToken();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ];

        $response = Http::withHeaders($headers)
            ->get(urlWayBill("sg", $tracking_number, $rules));

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {
            $pdfContent = $response->body();

            // Menentukan nama file PDF (misalnya, "waybill.pdf")
            $pdfFileName = 'waybill.pdf';

            // Mengatur tipe konten dan header agar file terunduh langsung
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $pdfFileName . '"',
            ];

            // Menggunakan fungsi response() untuk mengembalikan file PDF
            return Response::make($pdfContent, 200, $headers);
        } else {
            // Permintaan gagal
            $errorCode = $response->status();
            $errorMessage = $response->body();

            // Lakukan sesuatu dengan $errorCode dan $errorMessage
        }
    }
}

