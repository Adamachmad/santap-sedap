<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * Tentukan nama primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'id_transaksi'; // <-- TAMBAHKAN BARIS INI

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_harga',
        'pesanan',
        'status',
    ];

    /**
     * Mendefinisikan relasi bahwa satu Transaksi dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}