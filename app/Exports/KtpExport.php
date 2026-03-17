<?php

namespace App\Exports;

use App\Models\Ktp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KtpExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $ktps;

    public function __construct($ktps)
    {
        $this->ktps = $ktps;
    }

    public function collection()
    {
        return $this->ktps;
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Lengkap',
            'Alamat',
            'Jenis Kelamin',
            'Pekerjaan',
            'Agama',
            'Status Perkawinan',
            'Kewarganegaraan'
        ];
    }

}
?>


