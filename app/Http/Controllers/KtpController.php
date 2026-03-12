<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KtpController extends Controller
{
    /**
     * Display a listing of KTP data.
     */
    public function index()
    {
        $response = Http::get('127.0.0.1:8001/api/ktp');
        $ktps = $response->json()['data']; // Ambil array datanya
        // Show only first 4 for preview
        $previewData = array_slice($ktps, 0, 4);
        $totalCount = count($ktps);

        return view('ktp.index', compact('previewData', 'totalCount'));
    }

    /**
     * Display all KTP data.
     */
    public function showAll()
    {
        // Dummy data for demonstration
        $response = Http::get('127.0.0.1:8001/api/ktp');
        $ktpData = $response->json()['data']; // Ambil array datanya

        return view('ktp.show-all', compact('ktpData'));
    }
}

