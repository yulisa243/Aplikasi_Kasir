<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBroker;

class NewPasswordController extends Controller
{
    // Menampilkan form untuk reset password dengan token
    public function showResetForm($token)
    {
        // Mengambil email dari query string
        $email = request('email');
        
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }
    

    // Menangani reset password setelah pengguna mengisi form
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', 'Password berhasil di-reset.')
                    : back()->withErrors(['email' => trans($response)]);
    }
}

