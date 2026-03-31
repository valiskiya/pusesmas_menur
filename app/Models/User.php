<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user'; // Sesuaikan dengan PK di database kamu
    public $timestamps = false; // Karena tabel users kamu tidak punya kolom 'updated_at'

    protected $fillable = [
        'nama',
        'email',    // <-- SUDAH DISESUAIKAN (Sebelumnya username)
        'password',
        'role',     // enum: admin, staf
        'created_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed', // Password otomatis di-hash saat disimpan
    ];
}