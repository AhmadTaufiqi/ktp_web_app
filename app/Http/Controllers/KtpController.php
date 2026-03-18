<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ktp;
use App\Exports\KtpExport;
use Illuminate\Support\Facades\Storage;


class KtpController extends Controller
{
    /**
     * Display a listing of KTP data.
     */
    public function index()
    {
        return view('ktp.index');
    }

    /**
     * Display all KTP data.
     */
    public function showAll()
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
            'jenis_kelamin' => 'nullable|in:L,P',
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

    /**
     * Export KTP data to XLSX (all or filtered).
     */
    public function export(Request $request)
    {
        $query = Ktp::query();
        $query->select('nik', 'nama', 'alamat', 'jenis_kelamin', 'pekerjaan', 'agama', 'status_perkawinan', 'kewarganegaraan');

        if ($request->filled('name')) {
            $query
            ->where('nama', 'like', '%' . $request->name . '%');
        }

        $ktps = $query->get();

        return Excel::download(new KtpExport($ktps), 'data-ktp-' . date('Y-m-d-H-i-s') . '.xlsx');
    }

    /**
     * Show edit form for KTP.
     */
    public function edit($nik)
    {
        $ktp = Ktp::where('nik', $nik)->firstOrFail();
        return view('ktp.edit', compact('ktp'));
    }

    /**
     * Update KTP in database.
     */
    public function update(Request $request, $nik)
    {
        $ktp = Ktp::where('nik', $nik)->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string|max:500',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($ktp->foto) {
                Storage::disk('public')->delete($ktp->foto);
            }
            $path = $request->file('foto')->store('ktp', 'public');
            $validated['foto'] = $path;
        }

        $ktp->update($validated);

        return redirect()->route('ktp.showAll')->with('success', 'KTP berhasil diupdate!');
    }

    /**
     * PDF Export (Queue)
     */
    public function pdfExport(Request $request)
    {
        \App\Jobs\GenerateKtpPdf::dispatch();
        
        return redirect()->route('ktp.showAll')->with('success', 'PDF sedang digenerate di background! Cek download link dalam beberapa menit.');
    }

    /**
     * Delete KTP from database.
     */
    public function destroy($nik)
    {
        $ktp = Ktp::where('nik', $nik)->firstOrFail();

        if ($ktp->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($ktp->foto);
        }

        $ktp->delete();

        return response()->json(['success' => true]);
    }
}

