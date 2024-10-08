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
        Schema::create('curah_hujan_ispas', function (Blueprint $table) {
            $table->id();
            $table->json('geometry'); // Menyimpan geometry dalam format JSON
            $table->string('kecamatan', 255); // Menyimpan nama kecamatan
            $table->float('ch'); // CH dalam float (curah hujan)
            $table->string('kelas', 255); // Kelas disimpan sebagai varchar
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
        Schema::dropIfExists('curah_hujan_ispas');
    }
};
