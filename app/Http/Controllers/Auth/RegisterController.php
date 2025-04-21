<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrasiBerhasilMail; // Make sure this is imported
use Illuminate\Support\Facades\Mail; // Make sure this is imported
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'alamat' => 'required|string|max:255',  // Validasi alamat
            'no_telp' => 'required|string|max:15',  // Validasi no_telp
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'alamat' => $request->alamat,
        'no_telp' => $request->no_telp,
        'status' => 'bekerja',
        'is_active' => false, // <--- ini penting
    ]);
    

    // Kirim email notifikasi registrasi
    Mail::to($user->email)->send(new RegistrasiBerhasilMail($user));

    return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan cek email Anda.');
}


protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'is_active' => false, // akun belum aktif
    ]);
}

}
