<?php

namespace App\Http\Controllers;

use App\Models\Ktp;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function ktpIndex()
    {
        $ktps = Ktp::all();

        return response()->json([
            'success' => true,
            'data' => $ktps
        ]);
    }

    public function ktpStore(Request $request)
    {
        // Validasi data yang masuk ke API
        $validated = $request->validate([
            'nik'  => 'required|unique:ktps,nik',
            'nama' => 'required',
            'foto' => 'required|image',
        ]);

        // Proses Simpan Gambar
        if ($request->hasFile('foto')) {
            // Simpan ke folder 'public/ktp'
            $path = $request->file('foto')->store('ktp', 'public');
            $validated['foto'] = $path; // Simpan path/nama file ke database
        }

        // Simpan ke Database
        $ktp = Ktp::create($validated);

        return response()->json([
            'message' => 'Data KTP berhasil dibuat',
            'data'    => $ktp
        ], 201);
    }
}
