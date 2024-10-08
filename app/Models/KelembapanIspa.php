<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelembapanIspa extends Model
{
    use HasFactory;
    protected $fillable = ['kelembapan', 'geometry', 'kecamatan', 'kelas', 'tanggal', 'operator', 'gambar'];
}
