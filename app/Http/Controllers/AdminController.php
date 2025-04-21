<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
{
    $expiringProducts = Produk::where('tanggal_exp', '<=', now()->addDays(30))->get();
    
    return view('admin.dashboard', compact('expiringProducts'));
}

public function activateUser($id)
{
    $user = User::findOrFail($id);
    $user->is_active = true;
    $user->save();

    return redirect()->back()->with('success', 'User berhasil diaktifkan.');
}


}
