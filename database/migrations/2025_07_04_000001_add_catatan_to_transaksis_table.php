<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Menambahkan kolom 'catatan' ke tabel transaksis
 *
 * CRIT-02: Field catatan pesanan yang sebelumnya tidak tersimpan,
 * sekarang disimpan dengan benar ke database setelah divalidasi.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Tambahkan kolom catatan yang nullable (opsional dari pelanggan)
            $table->text('catatan')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }
};
