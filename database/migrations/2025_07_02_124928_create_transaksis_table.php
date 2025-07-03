<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id('id_transaksi');
        
        // Ganti dari customer_id ke user_id dan hubungkan ke tabel users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->decimal('total_harga', 10, 2);
        $table->text('pesanan');
        $table->string('status')->default('pending');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};