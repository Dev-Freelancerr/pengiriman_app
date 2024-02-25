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

    public function print_all(Request $request) {
        $data = OrderNinja::where('batch_id', $request->input('id'))->get();
        $pdfFiles = [];
        $accessToken = getAccessToken();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ];

        foreach($data as $item) {
            $response = Http::withHeaders($headers)
                ->get(urlWayBill("sg", $item->tracking_number, 1));

            // Memeriksa apakah permintaan berhasil
            if ($response->successful()) {
                $pdfContent = $response->body();
                $pdfFileName = 'waybill_'.$item->tracking_number.'.pdf';

                // Menambahkan konten PDF ke array
                $pdfFiles[] = [
                    'content' => $pdfContent,
                    'filename' => $pdfFileName,
                ];
            } else {
                // Permintaan gagal
                $errorCode = $response->status();
                $errorMessage = $response->body();
            }
        }

        // Mengatur tipe konten dan header agar file terunduh langsung
        $zipFileName = 'waybills_batch_' . $request->input('id') . '.zip';
        $headers = [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
        ];

        $zip = new \ZipArchive();
        $zipFilePath = tempnam(sys_get_temp_dir(), 'waybills_batch_');
        if ($zip->open($zipFilePath, \ZipArchive::CREATE)) {
            foreach ($pdfFiles as $pdfFile) {
                $zip->addFromString($pdfFile['filename'], $pdfFile['content']);
            }
            $zip->close();
        }

        // Mengembalikan response berupa file ZIP yang berisi semua PDF
        return response()->download($zipFilePath, $zipFileName, $headers)->deleteFileAfterSend(true);
    }


}

