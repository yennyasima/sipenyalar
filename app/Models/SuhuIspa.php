<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuhuIspa extends Model
{
    use HasFactory;
    protected $fillable = ['suhu', 'geometry', 'kecamatan', 'kelas_suhu', 'operator', 'gambar', 'tanggal'];
}
