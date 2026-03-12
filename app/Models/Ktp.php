<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ktp extends Model
{
    use HasFactory;

    protected $table = 'ktps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'foto',
    ];

    /**
     * Accessor untuk mempermudah pemanggilan URL foto di API/Blade
     * Contoh penggunaan: $ktp->foto_url
     */
    protected $appends = ['foto_url'];

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            // Mengambil URL lengkap dari folder storage/public
            return asset('storage/' . $this->foto);
        }

        // Return gambar default jika tidak ada foto
        return asset('images/default-ktp.png');
    }
}
