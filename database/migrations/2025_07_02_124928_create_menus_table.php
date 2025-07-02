<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu');
            $table->foreignId('id_penjual')->constrained('admins', 'id_penjual')->onDelete('cascade');
            $table->string('nama_menu');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2);
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};