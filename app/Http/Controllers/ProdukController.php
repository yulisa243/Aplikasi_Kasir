<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\models\profile;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produks = Produk::with(['suplier', 'category']) // Eager load suplier & category
            ->when($search, function ($query) use ($search) {
                return $query->where('NamaProduk', 'like', "%{$search}%")
                             ->orWhere('Harga', 'like', "%{$search}%")
                             ->orWhere('stok', 'like', "%{$search}%") // Sesuaikan dengan field di DB
                             ->orWhereDate('exp_date', 'like', "%{$search}%") // Gunakan orWhereDate jika field date
                             ->orWhereHas('category', function ($q) use ($search) {
                                 $q->where('CategoryName', 'like', "%{$search}%"); // Perbaikan field kategori
                             })
                             ->orWhereHas('suplier', function ($q) use ($search) {
                                 $q->where('SuplierNama', 'like', "%{$search}%"); // Perbaikan field suplier
                             });
            })
            ->latest() // Lebih ringkas dibanding orderBy('created_at', 'desc')
            ->get();

                // Ambil produk yang akan kedaluwarsa dalam 7 hari
                $produkKedaluwarsa = Produk::whereNotNull('exp_date')
                ->whereDate('exp_date', '<=', Carbon::today()->addDays(7))
                ->whereDate('exp_date', '>=', Carbon::today())
                ->get();
            

        return view('produks.index', compact('produks'));
    }

    public function home()
    {
        $produks = Produk::all();
        return view('home', compact('produks'));
    }

    public function create()
    {
        return view('produks.create', [
            'categories' => Category::all(),
            'supliers' => Suplier::all(),
        ]);
    }

    public function store(Request $request)
    {
            // dd($request->all()); // Cek apakah field Stok ada

        $validatedData = $request->validate([
            'CategoryID' => 'required|integer|exists:categories,CategoryID',
            'SuplierID' => 'required|integer|exists:supliers,SuplierID',
            'NamaProduk' => 'required|string|max:50',
            'Harga' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0', // Stok tidak boleh negatif
            'exp_date' => 'required|date|after_or_equal:today', // Tambahkan validasi exp_date
            'ExpiredDate' => 'nullable|date'

        ]);

        Produk::create($validatedData);

        return redirect()->route('produks.index')->with('success', 'Data berhasil ditambahkan.');
    }




    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        // dd($produk); // Periksa apakah 'Stok' ada
        $categories = Category::all();
        $supliers = Suplier::all();
        return view('produks.edit', compact('produk', 'categories', 'supliers'));
    }
    


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'CategoryID' => 'required|integer|exists:categories,CategoryID',
            'SuplierID' => 'required|integer|exists:supliers,SuplierID',
            'NamaProduk' => 'required|string|max:50',
            'Harga' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0', // Stok tidak boleh negatif
            'exp_date' => 'required|date|after_or_equal:today',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($validatedData);

        return redirect()->route('produks.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Data Berhasil Dihapus.');
    }



  public function exportProduksPDF()
    {
        $produks = Produk::all(); // Ambil semua kategori
    
        $profile = Profile::first(); // Ambil data profil dari tabel Profile


        $pdf = PDF::loadView('produks.laporan', compact('produks','profile'));
    
        return $pdf->download('Laporan Produk.pdf'); // File akan langsung diunduh
    }
}
