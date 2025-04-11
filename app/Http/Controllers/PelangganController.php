<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Profile;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pelanggans = Pelanggan::when($search, function ($query, $search) {
            return $query->where('NamaPelanggan', 'like', "%{$search}%")
                         ->orWhere('Alamat', 'like', "%{$search}%")
                         ->orWhere('Email', 'like', "%{$search}%")
                         ->orWhere('JenisKelamin', 'like', "%{$search}%")
                         ->orWhere('Notelp', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pelanggans.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggans.create'); // Tidak perlu mengambil semua pelanggan
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'required|string|max:500',
            'Notelp' => 'required|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'Email' => 'required|email|max:255|unique:pelanggans,Email',
            'JenisKelamin' => 'required|in:Laki-laki,Perempuan',
        ]);
        

        Pelanggan::create($validatedData);

        return redirect()->route('pelanggans.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id); // Menemukan pelanggan berdasarkan ID
        return view('pelanggans.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'NamaPelanggan' => 'required|string|max:255',
        'Alamat' => 'required|string|max:255',
        'Notelp' => 'required|numeric',
        'Email' => 'required|email|unique:pelanggans,Email,' . $id . ',PelangganID',
        'JenisKelamin' => 'required|in:Laki-laki,Perempuan',
    ]);

    $pelanggan = Pelanggan::findOrFail($id);
    $pelanggan->update($request->all());

    return redirect()->route('pelanggans.index')->with('success', 'Data pelanggan berhasil diperbarui.');
}


    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
    
        return redirect()->route('pelanggans.index')->with('success', 'Data Berhasil Dihapus.');
    }

    public function exportPDF()
    {
        $pelanggans = Pelanggan::all(); // Hanya member
    
        $profile = Profile::first(); // Ambil data profil dari tabel Profile

        $pdf = PDF::loadView('pelanggans.laporan', compact('pelanggans','profile'));
    
        return $pdf->download('Laporan Pelanggan.pdf'); // Mengubah dari stream() ke download()
    }

    
}