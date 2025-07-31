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
        Schema::create('pengambilans', function (Blueprint $table) {
            $table->id('id_pengambilan');
            $table->unsignedBigInteger('id_pemesanan');
            $table->date('tanggal_pengambilan');
            $table->text('kondisi_awal');
            $table->timestamps();
        
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengambilans');
    }
};
