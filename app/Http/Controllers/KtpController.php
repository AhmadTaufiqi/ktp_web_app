  <?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;

  class KtpController extends Controller
  {
      /**
       * Display a listing of KTP data.
       */
      public function index()
      {
          // Dummy data for demonstration - in production, this would come from database
          $ktpData = [
              [
                  'nik' => '3174010203050001',
                  'nama' => 'Ahmad Wijaya',
                  'tempat_lahir' => 'Jakarta',
                  'tanggal_lahir' => '1990-05-15',
                  'jenis_kelamin' => 'Laki-Laki',
                  'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Kawin',
                  'pekerjaan' => 'Pegawai Negeri',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3175012304080002',
                  'nama' => 'Siti Nurhaliza',
                  'tempat_lahir' => 'Bandung',
                  'tanggal_lahir' => '1992-08-22',
                  'jenis_kelamin' => 'Perempuan',
                  'alamat' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Belum Kawin',
                  'pekerjaan' => 'Wiraswasta',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3273011506030003',
                  'nama' => 'Budi Santoso',
                  'tempat_lahir' => 'Surabaya',
                  'tanggal_lahir' => '1985-03-10',
                  'jenis_kelamin' => 'Laki-Laki',
                  'alamat' => 'Jl. Asia Afrika No. 20, Bandung',
                  'agama' => 'Kristen',
                  'status_perkawinan' => 'Kawin',
                  'pekerjaan' => 'Dosen',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3174015609100004',
                  'nama' => 'Dewi Lestari',
                  'tempat_lahir' => 'Jakarta',
                  'tanggal_lahir' => '1995-10-16',
                  'jenis_kelamin' => 'Perempuan',
                  'alamat' => 'Jl. Thamrin No. 78, Jakarta Pusat',
                  'agama' => 'Hindu',
                  'status_perkawinan' => 'Belum Kawin',
                  'pekerjaan' => 'Mahasiswa',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3277010101250005',
                  'nama' => 'Rudi Hermawan',
                  'tempat_lahir' => 'Bekasi',
                  'tanggal_lahir' => '1988-01-01',
                  'jenis_kelamin' => 'Laki-Laki',
                  'alamat' => 'Jl. Ahmad Yani No. 33, Bekasi',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Kawin',
                  'pekerjaan' => 'Karyawan Swasta',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3175027802200006',
                  'nama' => 'Lisa Amelia',
                  'tempat_lahir' => 'Depok',
                  'tanggal_lahir' => '1998-02-18',
                  'jenis_kelamin' => 'Perempuan',
                  'alamat' => 'Jl. Margonda No. 55, Depok',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Belum Kawin',
                  'pekerjaan' => 'Guru',
                  'kewarganegaraan' => 'WNI',
              ],
          ];

          // Show only first 4 for preview
          $previewData = array_slice($ktpData, 0, 4);
          $totalCount = count($ktpData);

          return view('ktp.index', compact('previewData', 'totalCount'));
      }

      /**
       * Display all KTP data.
       */
      public function showAll()
      {
          // Dummy data for demonstration
          $ktpData = [
              [
                  'nik' => '3174010203050001',
                  'nama' => 'Ahmad Wijaya',
                  'tempat_lahir' => 'Jakarta',
                  'tanggal_lahir' => '1990-05-15',
                  'jenis_kelamin' => 'Laki-Laki',
                  'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Kawin',
                  'pekerjaan' => 'Pegawai Negeri',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3175012304080002',
                  'nama' => 'Siti Nurhaliza',
                  'tempat_lahir' => 'Bandung',
                  'tanggal_lahir' => '1992-08-22',
                  'jenis_kelamin' => 'Perempuan',
                  'alamat' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Belum Kawin',
                  'pekerjaan' => 'Wiraswasta',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3273011506030003',
                  'nama' => 'Budi Santoso',
                  'tempat_lahir' => 'Surabaya',
                  'tanggal_lahir' => '1985-03-10',
                  'jenis_kelamin' => 'Laki-Laki',
                  'alamat' => 'Jl. Asia Afrika No. 20, Bandung',
                  'agama' => 'Kristen',
                  'status_perkawinan' => 'Kawin',
                  'pekerjaan' => 'Dosen',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3174015609100004',
                  'nama' => 'Dewi Lestari',
                  'tempat_lahir' => 'Jakarta',
                  'tanggal_lahir' => '1995-10-16',
                  'jenis_kelamin' => 'Perempuan',
                  'alamat' => 'Jl. Thamrin No. 78, Jakarta Pusat',
                  'agama' => 'Hindu',
                  'status_perkawinan' => 'Belum Kawin',
                  'pekerjaan' => 'Mahasiswa',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3277010101250005',
                  'nama' => 'Rudi Hermawan',
                  'tempat_lahir' => 'Bekasi',
                  'tanggal_lahir' => '1988-01-01',
                  'jenis_kelamin' => 'Laki-Laki',
                  'alamat' => 'Jl. Ahmad Yani No. 33, Bekasi',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Kawin',
                  'pekerjaan' => 'Karyawan Swasta',
                  'kewarganegaraan' => 'WNI',
              ],
              [
                  'nik' => '3175027802200006',
                  'nama' => 'Lisa Amelia',
                  'tempat_lahir' => 'Depok',
                  'tanggal_lahir' => '1998-02-18',
                  'jenis_kelamin' => 'Perempuan',
                  'alamat' => 'Jl. Margonda No. 55, Depok',
                  'agama' => 'Islam',
                  'status_perkawinan' => 'Belum Kawin',
                  'pekerjaan' => 'Guru',
                  'kewarganegaraan' => 'WNI',
              ],
          ];

          return view('ktp.show-all', compact('ktpData'));
      }
  }

