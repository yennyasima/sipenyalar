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
        Schema::create('data_penyakit_ispas', function (Blueprint $table) {
            $table->id();
            $table->json('geometry'); // Menyimpan data geometris dalam format JSON
            $table->string('kecamatan', 255); // Nama kecamatan
            $table->float('luas_kec'); // Luas kecamatan dalam float
            $table->string('puskesmas', 255); // Nama puskesmas
            $table->integer('jumlah_balita'); // Jumlah balita
            $table->integer('jumlah_ispa_penderita'); // Jumlah penderita ISPA
            $table->float('nilai_range'); // Nilai range
            $table->string('kelas', 255); // Kelas
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
        Schema::dropIfExists('data_penyakit_ispas');
    }
};
