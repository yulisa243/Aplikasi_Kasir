<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KasirController extends Controller
{
    /**
     * Menampilkan daftar kasir.
     */
    public function index()
    {
        $kasir = User::where('role', 'user')->get();
        return view('kassir.index', compact('kasir'));
    }

    /**
     * Menampilkan form edit kasir.
     */
    public function edit($id)
    {
        $kasir = User::findOrFail($id);
        return view('kassir.edit', compact('kasir'));
    }

    /**
     * Menyimpan perubahan data kasir.
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|string|in:bekerja,tidak bekerja',  // Validasi status pekerjaan
        ]);
    
        // Temukan data kasir berdasarkan ID
        $kasir = User::findOrFail($id);
    
        // Perbarui data kasir
        $kasir->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,  // Menambahkan pembaruan status pekerjaan
        ]);
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('kassir.index')->with('success', 'Data kasir berhasil diperbarui.');
    }
    
    /**
     * Menghapus kasir.
     */
    public function destroy($id)
    {
        $kasir = User::findOrFail($id);
        $kasir->delete();

        return redirect()->route('kassir.index')->with('success', 'Kasir berhasil dihapus.');
    }


    public function activate($id)
{
    $kasir = Kasir::findOrFail($id);
    $kasir->is_active = true;  // Mengubah status menjadi aktif
    $kasir->save();

    return redirect()->route('kasir.index')->with('success', 'Kasir berhasil diaktifkan!');
}

public function show($id)
    {
        // Find the kasir by its ID
        $kasir = User::findOrFail($id);  // Change from Kasir to User

        // Return a view with the kasir data
        return view('kassir.show', compact('kasir'));
    }
}
