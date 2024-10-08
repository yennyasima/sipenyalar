<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenyakitIspa extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['geometry', 'kecamatan', 'luas_kec', 'puskesmas', 'jumlah_balita', 'jumlah_ispa_penderita', 'nilai_range', 'kelas', 'tanggal', 'operator', 'gambar'];
}
