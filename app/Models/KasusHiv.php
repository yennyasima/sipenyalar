<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusHiv extends Model
{
    use HasFactory;
    protected $fillable = ['geometry', 'kecamatan', 'ha_kasus', 'kelas_hiv', 'operator', 'gambar', 'tanggal'];
}
