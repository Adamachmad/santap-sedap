<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('nama_menu');
        $table->text('deskripsi')->nullable();
        $table->decimal('harga', 10, 2);
        $table->string('gambar')->nullable();
        $table->string('kategori')->default('Makanan'); // Tambahkan kolom kategori jika belum ada

        // LANGSUNG hubungkan ke tabel users dengan benar
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};