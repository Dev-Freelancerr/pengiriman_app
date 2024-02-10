<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function downloadSample()
    {
        $filePath = storage_path('app/public/sample_domestic.xlsx');

        return response()->download($filePath, 'sample_domestic.xlsx');
    }
}
