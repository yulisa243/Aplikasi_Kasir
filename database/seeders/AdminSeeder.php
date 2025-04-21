<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        // Cek apakah admin sudah ada
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'), // Gantilah dengan password yang lebih kuat
                'role' => 'admin', // Menambahkan role admin
                'alamat' => '',  // Memberikan nilai default kosong
                'no_telp' => '', // Memberikan nilai default kosong
            ]);
        }
    }
}
