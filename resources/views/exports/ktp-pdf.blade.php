<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data KTP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #333; }
        .header { text-align: center; margin-bottom: 40px; }
        .header h1 { color: #2c3e50; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #4472C4; color: white; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 40px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Kartu Tanda Penduduk (KTP)</h1>
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>Agama</th>
                <th>Status Perkawinan</th>
                <th>Kewarganegaraan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ktps as $ktp)
            <tr>
                <td>{{ $ktp->nik }}</td>
                <td>{{ $ktp->nama }}</td>
                <td>{{ $ktp->alamat }}</td>
                <td>{{ $ktp->jenis_kelamin }}</td>
                <td>{{ $ktp->pekerjaan }}</td>
                <td>{{ $ktp->agama }}</td>
                <td>{{ $ktp->status_perkawinan }}</td>
                <td>{{ $ktp->kewarganegaraan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 50px; color: #999;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total: {{ $ktps->count() }} data | Sistem KTP Web Apps</p>
    </div>
</body>
</html>
