<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable; // ⬅️ tambahkan ini
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // ⬅️ tambahkan Notifiable di sini

        // Di app/Models/User.php
    protected $table = 'users';  // Ini hanya diperlukan jika Anda mengganti nama tabel default

        // app/Models/User.php
    protected $fillable = [
        'name',
        'email',
        'alamat',
        'no_telp',
        'status',
        'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
