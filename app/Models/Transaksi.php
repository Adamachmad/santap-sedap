<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_customer',
        'total_harga',
        'pesanan_detail',
        'status',
    ];

    protected $casts = [
        'pesanan_detail' => 'array', // Otomatis mengubah JSON menjadi array
    ];

    // Relasi ke model Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}