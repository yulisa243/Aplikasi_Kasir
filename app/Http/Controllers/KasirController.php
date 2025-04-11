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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $kasir = User::findOrFail($id);
        $kasir->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

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
}
