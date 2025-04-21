<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Debugging login (opsional, bisa dihapus setelah berhasil)
        $credentials = $request->only('email', 'password');
        
        // Cek apakah credentials cocok
        if (Auth::attempt($credentials)) {
            // Arahkan pengguna ke halaman home setelah berhasil login
            return redirect()->intended('/home');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
    }

    protected function authenticated(Request $request, $user)
    {
        // Periksa apakah status pekerjaan pengguna adalah 'tidak bekerja'
        if ($user->status == 'tidak bekerja') {
            Auth::logout();  // Keluar dari sesi login
            return redirect()->route('login')->withErrors(['status' => 'Akun Anda tidak aktif, harap hubungi administrator.']);
        }

        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
    
    
}
