<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans'; // Nama tabel
    protected $primaryKey = 'PelangganID'; // Primary key
    public $incrementing = true; // Auto increment
    protected $keyType = 'int'; // Tipe primary key

    protected $fillable = [
        'NamaPelanggan',
        'Alamat',
        'Notelp',
        'Email',
        'JenisKelamin',
    ];

}