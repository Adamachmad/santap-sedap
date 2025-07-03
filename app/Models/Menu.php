<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Dengan menghapus baris 'protected $primaryKey = ...;',
    // Laravel akan otomatis menggunakan 'id' sebagai primary key.

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'deskripsi',
        'gambar',
        'user_id',
    ];

    /**
     * Mendefinisikan relasi bahwa satu Menu dimiliki oleh satu User (admin).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}