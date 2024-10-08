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
        Schema::create('data_penyakit_dbds', function (Blueprint $table) {
            $table->id();
            $table->string('remark', 255);
            $table->string('kelurahan', 255);
            $table->string('kecamatan', 255);
            $table->integer('kasus');
            $table->string('tingkat_ka', 255);
            $table->json('geometry');
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
        Schema::dropIfExists('data_penyakit_dbds');
    }
};
