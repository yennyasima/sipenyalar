<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepadatanPendudukDbd extends Model
{
    use HasFactory;
    protected $table = 'kepadatan_penduduk_dbds';

    protected $fillable = ['remark', 'kelurahan', 'kecamatan', 'LK', 'PR', 'kepadatan', 'geometry', 'tingkat_ka', 'gambar', 'operator', 'tanggal'];
}
