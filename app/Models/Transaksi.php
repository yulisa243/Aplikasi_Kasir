<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Laravel otomatis menangani pluralisasi
    protected $fillable = ['PelangganID', 'TotalHarga', 'status']; // Sesuaikan dengan kolom di database

    // Relasi ke tabel pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID');
    }

    // Relasi ke detail transaksi
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'TransaksiID'); // Perbaiki dari 'DetailID'
    }

    // Cast tipe data
    protected $casts = [
        'TotalHarga' => 'decimal:2', // Memastikan total dalam format desimal
    ];
}
