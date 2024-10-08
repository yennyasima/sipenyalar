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
        Schema::create('kepadatan_penduduk_ispas', function (Blueprint $table) {
            $table->id();
            $table->json('geometry'); // Menyimpan data geometris dalam format JSON
            $table->string('kecamatan', 255); // Nama kecamatan
            $table->integer('kpdt_bps'); // Kepadatan penduduk berdasarkan BPS tahun 2021
            $table->string('kelas_kpdt', 255); // Kelas kepadatan
            $table->string('operator');
            $table->date('tanggal');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepadatan_penduduk_ispas');
    }
};
