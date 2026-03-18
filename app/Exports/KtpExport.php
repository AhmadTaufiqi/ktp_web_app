<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KtpExport implements FromCollection, WithHeadings
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


