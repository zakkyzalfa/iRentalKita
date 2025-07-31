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
        Schema::create('iphones', function (Blueprint $table) {
            $table->id('id_iphone');
            $table->string('tipe_iphone', 50); // misalnya: iPhone 15 Pro Max
            $table->string('imei', 20)->unique(); // misalnya: 1234567890123456
            $table->string('warna'); // misalnya: Hitam
            $table->enum('kondisi', ['baik', 'rusak'])->default('baik');
            $table->integer('harga_per_hari');
            $table->string('gambar')->nullable(); // nama file gambar
            $table->enum('status', ['tersedia', 'disewa'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iphones', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }


    
};
