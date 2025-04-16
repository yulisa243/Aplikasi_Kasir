<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\models\Profile;
class SuplierController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $supliers = Suplier::when($search, function ($query, $search) {
            return $query->where('SuplierNama', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('supliers.index', compact('supliers'));
    }

    public function create()
    {
        return view('supliers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'SuplierNama' => 'required|string|max:255',
        ]);

        Suplier::create($validatedData);

        return redirect()->route('supliers.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view('supliers.edit', compact('suplier'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'SuplierNama' => 'required|string|max:255',
        ]);

        $suplier = Suplier::findOrFail($id);
        $suplier->update($validatedData);

        return redirect()->route('supliers.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $suplier = Suplier::findOrFail($id);
        $suplier->delete();

        return redirect()->route('supliers.index')->with('success', 'Data berhasil dihapus.');
    }


    public function exportSupliersPDF()
    {
        $supliers = Suplier::all(); // Ambil semua data penjualan
    
        $profile = Profile::first(); // Ambil data profil dari tabel Profile


        $pdf = PDF::loadView('supliers.laporan', compact('supliers','profile'));
    
        return $pdf->download('Laporan Suplier.pdf'); // File akan langsung diunduh
    }

}
