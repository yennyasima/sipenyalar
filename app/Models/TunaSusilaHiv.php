<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TunaSusilaHiv extends Model
{
    use HasFactory;
    protected $fillable = ['geometry', 'kecamatan', 'tn_susila', 'kelas', 'tanggal', 'operator', 'gambar'];
}
