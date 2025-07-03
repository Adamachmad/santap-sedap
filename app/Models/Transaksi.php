<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Pastikan ini user_id, bukan customer_id
        'total_harga',
        'pesanan',
        'status',
    ];

    /**
     * Mendefinisikan relasi bahwa satu Transaksi dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}