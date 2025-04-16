<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first(); // Ambil data pertama
        return view('profile.index', compact('profile'));
    }


    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'logo' => 'nullable|image|max:2048'
        ]);

        $profile = new Profile();
        $profile->nama_toko = $request->nama_toko;
        $profile->alamat = $request->alamat;
        $profile->no_telp = $request->no_telp;

        // Simpan Logo (Jika Ada)
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $profile->logo = $path;
        }

        $profile->save();

        return redirect()->route('profile.index')->with('success', 'Profil toko berhasil ditambahkan.');
    }



    public function edit()
    {
        $profile = Profile::first();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'logo' => 'nullable|image|max:2048'
        ]);
    
        $profile = Profile::first();
    
        // Perbarui Data Profil
        $profile->nama_toko = $request->nama_toko;
        $profile->alamat = $request->alamat;
        $profile->no_telp = $request->no_telp;
    
        // Jika ada file logo baru, simpan dan perbarui path
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $profile->logo = $path;
        }
    
        $profile->save();
    
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
    }

    
    public function boot()
{
    View::share('profile', Profile::first());
}

    
}
