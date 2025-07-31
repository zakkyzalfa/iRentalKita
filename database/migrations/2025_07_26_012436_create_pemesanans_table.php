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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->unsignedBigInteger('id_penyewa');
            $table->unsignedBigInteger('id_iphone');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->timestamps();
        
            $table->foreign('id_penyewa')->references('id_penyewa')->on('penyewas')->onDelete('cascade');
            $table->foreign('id_iphone')->references('id_iphone')->on('iphones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
