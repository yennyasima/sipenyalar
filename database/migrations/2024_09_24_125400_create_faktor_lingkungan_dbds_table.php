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
        Schema::create('faktor_lingkungan_dbds', function (Blueprint $table) {
            $table->id();
            $table->string('remark', 255); // Menyimpan keterangan seperti "Wilayah Administrasi Kelurahan/Desa"
            $table->string('kelurahan', 255); // Menyimpan nama kelurahan
            $table->string('kecamatan', 255); // Menyimpan nama kecamatan
            $table->float('curah_hujan'); // Menyimpan curah hujan dalam mm
            $table->float('kelembapan'); // Menyimpan kelembaban dalam %
            $table->float('suhu'); // Menyimpan suhu dalam derajat Celsius
            $table->string('tingkat_ka_suhu', 255); // Menyimpan tingkat kasus suhu
            $table->string('tingkat_ka_curah_hujan', 255); // Menyimpan tingkat kasus curah hujan
            $table->string('tingkat_ka_kelembapan', 255); // Menyimpan tingkat kasus kelembaban
            $table->string('operator');
            $table->string('gambar');
            $table->date('tanggal');
            $table->json('geometry');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktor_lingkungan_dbds');
    }
};
