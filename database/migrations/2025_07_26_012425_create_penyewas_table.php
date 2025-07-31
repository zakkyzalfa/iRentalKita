<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyewas', function (Blueprint $table) {
            $table->id('id_penyewa');
            $table->string('nama', 50);
            $table->string('email')->unique();         // ⬅️ Tambahkan ini
            $table->string('password');                // ⬅️ Dan ini
            $table->string('alamat', 100);
            $table->string('no_hp', 15);
            $table->string('no_ktp', 20);
            $table->date('tanggal_daftar');            // Gunakan DATE, bukan integer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewas');
    }
};
