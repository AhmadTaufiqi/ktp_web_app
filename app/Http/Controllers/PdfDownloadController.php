<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PdfDownloadController extends Controller
{
    public function downloadKtpPdf()
    {
        $filename = Cache::get('ktp_pdf_filename');
        
        if (!$filename || !Storage::disk('public')->exists('exports/' . $filename)) {
            return redirect()->route('ktp.showAll')->with('error', 'PDF belum siap atau sudah expired.');
        }

        return Storage::disk('public')->download('exports/' . $filename);
    }
}

