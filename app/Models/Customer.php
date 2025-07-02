<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_customer'; // Menentukan primary key

    protected $fillable = [
        'nama_customer',
        'email',
        'no_hp',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}