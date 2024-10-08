<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kepadatan_penduduk_dbds', function (Blueprint $table) {
            $table->id();
            $table->string('remark', 255); // Menyimpan keterangan seperti "Wilayah Administrasi Kelurahan/Desa"
            $table->string('kelurahan', 255); // Menyimpan nama kelurahan
            $table->string('kecamatan', 255); // Menyimpan nama kecamatan
            $table->integer('LK'); // Menyimpan jumlah penduduk laki-laki
            $table->integer('PR'); // Menyimpan jumlah penduduk perempuan
            $table->float('kepadatan', 9, 9); // Menyimpan kepadatan penduduk per area
            $table->json('geometry'); // Menyimpan data spasial (MultiPolygon)
            $table->string('tingkat_ka', 255); // Menyimpan tingkat kasus
            $table->string('gambar');
            $table->string('operator');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepadatan_penduduk_dbds');
    }
};
