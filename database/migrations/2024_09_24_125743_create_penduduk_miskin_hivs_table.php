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
        Schema::create('penduduk_miskin_hivs', function (Blueprint $table) {
            $table->id();
            $table->json('geometry'); // Data geometry disimpan dalam format JSON
            $table->string('kecamatan', 255); // Nama kecamatan
            $table->float('pdd_miskin'); // Data penduduk miskin dalam float
            $table->string('kelas', 255); // Kelas dalam varchar
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
        Schema::dropIfExists('penduduk_miskin_hivs');
    }
};
