<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Tampilkan form registrasi
    }

    /**
     * Proses registrasi pengguna baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input pengguna
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', // Nama pengguna wajib diisi dan maksimal 255 karakter
            'email' => 'required|email|unique:users,email', // Email wajib diisi dan harus unik
            'password' => 'required|string|min:6|confirmed', // Password wajib diisi, minimal 6 karakter dan konfirmasi password
        ]);

        // Jika validasi gagal, kembali ke form registrasi dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses penyimpanan pengguna baru ke dalam database
        User::create([
            'name' => $request->name, // Menyimpan nama
            'email' => $request->email, // Menyimpan email
            'password' => Hash::make($request->password), // Menyimpan password yang sudah di-hash
            'role' => 'user', // Memberikan role default sebagai 'user', bisa disesuaikan
        ]);

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
