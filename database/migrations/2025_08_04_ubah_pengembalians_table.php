<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->text('alasan_denda')->nullable()->after('denda');
            $table->string('status_bayar')->default('belum')->after('alasan_denda');
            $table->string('metode_bayar')->nullable()->after('status_bayar');
            $table->dateTime('tanggal_bayar')->nullable()->after('metode_bayar');
            $table->string('status_pengembalian')->default('menunggu')->after('tanggal_bayar');
            $table->integer('keterlambatan_hari')->default(0)->after('status_pengembalian');
            $table->text('catatan_admin')->nullable()->after('keterlambatan_hari');
        });
    }

    public function down(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->dropColumn([
                'alasan_denda',
                'status_bayar',
                'metode_bayar',
                'tanggal_bayar',
                'status_pengembalian',
                'keterlambatan_hari',
                'catatan_admin'
            ]);
        });
    }
};