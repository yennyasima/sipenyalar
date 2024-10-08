<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurahHujanIspa extends Model
{
    use HasFactory;

    protected $fillable = [ 'geometry', 'kecamatan', 'ch', 'kelas', 'operator', 'tanggal', 'gambar'];
}
