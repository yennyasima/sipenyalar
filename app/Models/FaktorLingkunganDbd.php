<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaktorLingkunganDbd extends Model
{
    use HasFactory;
    protected $table = 'faktor_lingkungan_dbds';

    protected $fillable = ['remark', 'kelurahan', 'kecamatan', 'curah_hujan', 'kelembapan', 'suhu', 'geometry', 'tingkat_ka_suhu', 'tingkat_ka_curah_hujan', 'tingkat_ka_kelembapan', 'operator', 'tanggal', 'gambar'];
}
