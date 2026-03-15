<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Ktp;

class KtpController extends Controller
{
    /**
     * Display a listing of KTP data.
     */
    public function index()
    {
        // $response = Http::get('127.0.0.1:8001/api/ktp');
        // $ktps = $response->json()['data']; // Ambil array datanya
        // // Show only first 4 for preview
        // $previewData = array_slice($ktps, 0, 4);
        // $totalCount = count($ktps);

        return view('ktp.index');
    }

    /**
     * Display all KTP data.
     */
    public function showAll(Request $request)
    {
        return view('ktp.show-all');
    }

    public function create() 
    {
        return view('ktp.create');
    }

    /**
     * Store a newly created KTP in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:ktps,nik',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string|max:500',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('ktp', 'public');
            $validated['foto'] = $path;
        }

        Ktp::create($validated);

        return redirect()->route('ktp.showAll')->with('success', 'KTP berhasil ditambahkan!');
    }
}

