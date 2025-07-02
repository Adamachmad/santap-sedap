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
            $table->foreignId('id_customer')->constrained('customers', 'id_customer')->onDelete('cascade');
            $table->decimal('total_harga', 10, 2);
            $table->json('pesanan_detail'); // Menyimpan detail pesanan sebagai JSON
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};