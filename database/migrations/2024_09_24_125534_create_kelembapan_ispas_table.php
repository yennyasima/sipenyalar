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
        Schema::create('kelembapan_ispas', function (Blueprint $table) {
            $table->id();
            $table->float('kelembapan'); // Kelembapan dalam float
            $table->json('geometry'); // Menyimpan geometry dalam format JSON
            $table->string('kecamatan', 255); // Menyimpan nama kecamatan
            $table->string('kelas', 255); // Menyimpan kelas dalam varchar
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
        Schema::dropIfExists('kelembapan_ispas');
    }
};
