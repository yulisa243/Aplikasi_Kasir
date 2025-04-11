<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'PenjualanID';
    protected $fillable = [
        'PelangganID',
        'TanggalPenjualan',
        'ProdukID',
        'TotalHarga',
        'Kasir',
        'Pembayaran',
        'Kembalian',
        'deleted_by',

    ];

    use SoftDeletes;

    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'PenjualanID');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID');
    }

    
}
