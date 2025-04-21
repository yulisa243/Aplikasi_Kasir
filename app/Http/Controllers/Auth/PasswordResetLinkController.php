<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordresetLinkController extends Controller
{
    // Menampilkan form untuk memasukkan email reset password
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirimkan link reset password ke email pengguna
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', trans($response))
                    : back()->withErrors(['email' => trans($response)]);
    }
}

