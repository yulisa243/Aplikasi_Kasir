<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'supliers'; // Nama tabel
    protected $primaryKey = 'SuplierID'; // Primary key
    public $incrementing = true; // Auto increment
    protected $keyType = 'int'; // Tipe primary key

    protected $fillable = [
        'SuplierNama',
    ];
}
