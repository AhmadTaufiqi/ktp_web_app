<?php

namespace App\Http\Controllers;

use App\Models\Ktp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function ktpIndex(Request $request)
    {
        $query = Ktp::query();
        
        if ($name = $request->get('name')) {
            $query->where('nama', 'like', '%' . $name . '%');
        }
        
        $perPage = $request->get('per_page', 12);
        $ktps = $query->paginate($perPage);

        // Calculate total stats across all pages
        $totalMale = Ktp::where('jenis_kelamin', 'L')
                ->orWhere('jenis_kelamin', 'Laki-Laki')
                ->count();
        $totalFemale = Ktp::where('jenis_kelamin', 'P')
                ->orWhere('jenis_kelamin', 'Perempuan')
                ->count();
        $totalCities = Ktp::whereNotNull('alamat')->get()->reduce(function ($carry, $item) {
            $parts = explode(',', $item->alamat);
            $city = trim(end($parts));
            $carry[$city] = true;
            return $carry;
        }, []);
        return response()->json([
            'success' => true,
            'data' => $ktps->items(),
            'pagination' => [
                'total' => $ktps->total(),
                'per_page' => $ktps->perPage(),
                'current_page' => $ktps->currentPage(),
                'last_page' => $ktps->lastPage(),
                'from' => $ktps->firstItem(),
                'to' => $ktps->lastItem(),
                'stats' => [
                    'male' => $totalMale,
                    'female' => $totalFemale,
                    'cities' => count($totalCities)
                ]
            ]
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

    public function import(Request $request)
    {
        $ktp = new Ktp;
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:10240', // 10MB
        ]);

        $file = $request->file('csv_file');
        $importId = uniqid('import_');
        
        Cache::put("import_progress_{$importId}", 0, now()->addMinutes(10));
        Cache::put("import_result_{$importId}", ['imported' => 0, 'errors' => []], now()->addMinutes(10));

        // Process async-like with cache updates (real-time progress)
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle); // Skip header
        $totalRows = $this->countCsvRows($file->getRealPath()) - 1;
        $imported = 0;
        $errors = [];

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            $data = array_filter($data, fn($v) => $v !== '');

            try {
                Ktp::updateOrCreate(
                    ['nik' => $data['nik'] ?? ''],
                    array_intersect_key($data, array_flip($ktp->getColumns()))
                );
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row: " . implode(',', $row) . " - " . $e->getMessage();
            }

            $progress = ($imported / $totalRows) * 100;
            Cache::put("import_progress_{$importId}", $progress, now()->addMinutes(10));
        }

        fclose($handle);

        Cache::put("import_progress_{$importId}", 100, now()->addMinutes(10));
        Cache::put("import_result_{$importId}", [
            'imported' => $imported,
            'errors' => $errors
        ], now()->addMinutes(1));

        return response()->json([
            'success' => true,
            'import_id' => $importId
        ]);
    }

    private function countCsvRows($path)
    {
        $lines = 0;
        $handle = fopen($path, 'r');
        while (!feof($handle)) {
            fgets($handle);
            $lines++;
        }
        fclose($handle);
        return $lines;
    }

    public function importProgress($id)
    {
        $progress = Cache::get("import_progress_{$id}", 0);
        $result = Cache::get("import_result_{$id}", null);
        
        $done = $progress >= 100 || $result !== null;

        return response()->json([
            'progress' => $progress ?? 0,
            'result' => $result,
            'done' => $done
        ]);
    }

    /**
     * Delete KTP via API for JS.
     */
    public function destroy($nik)
    {
        $ktp = Ktp::where('nik', $nik)->firstOrFail();

        if ($ktp->foto) {
            Storage::disk('public')->delete($ktp->foto);
        }

        $ktp->delete();

        return response()->json(['success' => true]);
    }
}
