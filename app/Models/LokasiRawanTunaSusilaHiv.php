<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiRawanTunaSusilaHiv extends Model
{
    use HasFactory;
    protected $fillable = ['geometry', 'kecamatan', 'lok_pros', 'operator', 'tanggal', 'gambar'];
}
