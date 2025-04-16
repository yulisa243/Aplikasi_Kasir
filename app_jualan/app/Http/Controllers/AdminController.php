<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $expiringProducts = Produk::where('tanggal_exp', '<=', now()->addDays(30))->get();
    
    return view('admin.dashboard', compact('expiringProducts'));
}

}
