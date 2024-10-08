<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukMiskinHiv extends Model
{
    use HasFactory;
    protected $fillable = ['geometry', 'kecamatan', 'pdd_miskin', 'kelas', 'operator', 'tanggal', 'gambar'];
}
