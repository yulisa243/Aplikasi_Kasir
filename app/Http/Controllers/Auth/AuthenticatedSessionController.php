<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // Autentikasi user
        $request->authenticate();
    
        // Mendapatkan user yang login
        $user = Auth::user();

        // Cek apakah status user 'tidak bekerja'
        if ($user->status === 'tidak bekerja') {
            // Logout user yang tidak bekerja
            Auth::logout();

            // Redirect ke halaman login dengan pesan error
            return redirect()->route('login.form')->withErrors([
                'status' => 'Akun Anda tidak aktif.'
            ]);
        }

        // Regenerasi session setelah login sukses
        $request->session()->regenerate();

        // Redirect ke halaman utama setelah login
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Menghancurkan session pengguna yang sudah login (logout).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
