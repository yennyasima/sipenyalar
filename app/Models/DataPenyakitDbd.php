<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenyakitDbd extends Model
{
    use HasFactory;
    protected $table = 'data_penyakit_dbds';

    protected $fillable = ['remark', 'kelurahan', 'kecamatan', 'kasus', 'tingkat_ka', 'geometry', 'operator', 'tanggal', 'gambar'];
}
