<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Ktp;
use Illuminate\Support\Facades\Storage;

class GenerateKtpPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300; // 5 minutes
    protected $filename;

    public function __construct()
    {
        $this->filename = 'data-ktp-' . date('Y-m-d-H-i-s') . '.pdf';
    }

    public function handle()
    {
        $ktps = Ktp::limit(500)->get(); // Limit for performance
        $pdf = PDF::loadView('exports.ktp-pdf', compact('ktps'));

        Storage::disk('public')->put('exports/' . $this->filename, $pdf->output());

        // Store filename in cache for download
        cache(['ktp_pdf_filename' => $this->filename], 3600); // 1 hour
    }
}

