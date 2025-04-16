<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['JumlahProduk',  'PenjualanID', 'ProdukID'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanID');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID');
    }
}

