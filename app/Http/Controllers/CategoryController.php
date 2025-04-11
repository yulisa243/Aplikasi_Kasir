<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\models\profile;
class CategoryController extends Controller
{


    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('CategoryName', 'like', "%{$search}%"); // Sesuaikan dengan nama kolom yang benar
        })
        ->orderBy('created_at', 'desc')
        ->get();
    
        return view('categories.index', compact('categories'));
    }
    


    public function create()
    {
        $categories = Category::all();

        return view ('categories.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'CategoryName' => 'required|string|max:50',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }


    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'CategoryName' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Data berhasil diubah.');
    }

  
    public function destroy($id)
    {
        // Temukan proyek berdasarkan ID
       $category = Category::findOrFail($id);
        
       // Hapus proyek
       $category->delete();

       // Kembali dengan pesan sukses
       return redirect()->route('categories.index')->with('success', 'Data berhasil dihapus.');
    }



 public function exportCategoriesPDF()
{
    $categories = Category::all(); // Ambil semua kategori

    $profile = Profile::first(); // Ambil data profil dari tabel Profile


    $pdf = PDF::loadView('categories.laporan', compact('categories','profile'));

    return $pdf->download('Laporan Kategori.pdf'); // File akan langsung diunduh
}


}
