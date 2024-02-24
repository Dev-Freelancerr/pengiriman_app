<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function downloadSample()
    {
        $filePath = storage_path('app/public/example.xlsx');

        return response()->download($filePath, 'example.xlsx');
    }
}
