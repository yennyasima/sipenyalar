<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahRentanHiv extends Model
{
    use HasFactory;
    protected $fillable = ['geometry', 'kecamatan', 'nilai_wr', 'kelas', 'gambar', 'operator', 'tanggal'];
}
