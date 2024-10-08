<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepadatanPendudukIspa extends Model
{
    use HasFactory;
    protected $fillable = ['geometry', 'kecamatan', 'kpdt_bps', 'kelas_kpdt', 'operator', 'tanggal', 'gambar'];
}
