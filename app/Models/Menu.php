<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'id_penjual',
        'nama_menu',
        'deskripsi',
        'harga',
        'gambar',
    ];

    // Relasi ke model Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_penjual');
    }
}