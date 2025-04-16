<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // Sesuaikan dengan nama tabel yang digunakan
    protected $primaryKey = 'ProdukID'; // Primary key
    public $incrementing = true; // Auto increment
    protected $keyType = 'int'; // Tipe primary key

    protected $fillable = [
        'CategoryID',
        'SuplierID',
        'NamaProduk',
        'Harga',
        'Stok', // Pastikan lowercase sesuai dengan database
        'exp_date', // Tambahkan untuk mencatat masa kedaluwarsa
        'diskon', // Tambahkan untuk menyimpan diskon
    ];

    // Relasi ke tabel Supplier
    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'SuplierID');
    }

    // Relasi ke tabel Kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }
    
    public function setStokAttribute($value)
    {
        $this->attributes['Stok'] = max(0, $value); // Jika kurang dari 0, set jadi 0
    }
    
    // Scope untuk mengambil produk yang hampir kedaluwarsa (kurang dari 30 hari)
    public function scopeProdukHampirExpired($query)
    {
        return $query->where('exp_date', '<=', Carbon::now()->addDays(30));
    }

    // Cek apakah produk sudah kadaluarsa
    public function isExpired()
    {
        return $this->exp_date <= Carbon::now();
    }
}
