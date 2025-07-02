<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin'; // Menentukan guard untuk admin

    protected $primaryKey = 'id_penjual'; // Menentukan primary key

    protected $fillable = [
        'nama_toko',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}