<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\StrukEmail;
use App\Models\Profile;

    
class PenjualanController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $penjualans = Penjualan::with(['pelanggan'])
            ->when($search, function ($query, $search) {
                return $query->where('TanggalPenjualan', 'like', "%{$search}%")
                    ->orWhere('TotalHarga', 'like', "%{$search}%")
                    ->orWhere('Kasir', 'like', "%{$search}%")  // Menambahkan pencarian untuk Kasir
                    ->orWhereHas('pelanggan', function ($q) use ($search) {
                        $q->where('NamaPelanggan', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penjualans.index', compact('penjualans'));
    }


    public function create()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Jika login, ambil nama pengguna yang sedang login
            $kasir = Auth::user()->name;
        } else {
            // Jika belum login, tampilkan nama default
            $kasir = 'Pengguna Tidak Dikenal';
        }
    
        // Ambil data pelanggan dan produk untuk ditampilkan di form
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
    
        // Kirimkan data ke view
        return view('penjualans.create', compact('pelanggans', 'produks', 'kasir'));
    }
    

    public function store(Request $request)
    {

        
        $validated = $request->validate([
            'PelangganID' => 'nullable|exists:pelanggans,PelangganID',
            'ProdukID' => 'required|array|min:1',
            'ProdukID.*' => 'exists:produks,ProdukID',
            'JumlahProduk' => 'required|array|min:1',
            'Kasir' => 'required|string',
            'JumlahProduk.*' => 'numeric|min:1',
            'Pembayaran' => 'required|numeric|min:0',
            'TanggalPenjualan' => 'required|date',  // Pastikan validasi tanggal ada
        ]);
        
        $totalHarga = 0;
        $penjualanDetail = [];
    
        foreach ($validated['ProdukID'] as $index => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlah = $validated['JumlahProduk'][$index];
            $subtotal = $produk->Harga * $jumlah;
            $totalHarga += $subtotal;

            // Tambahkan ke detail penjualan
            $penjualanDetail[] = [
                'ProdukID' => $produkId,
                'JumlahProduk' => $jumlah,
                'Subtotal' => $subtotal,
            ];
    
            // Kurangi stok produk
            $produk->decrement('Stok', $jumlah);
        }
    
        if ($validated['Pembayaran'] < $totalHarga) {
            return redirect()->back()
                ->withErrors(['Pembayaran' => 'Pembayaran tidak mencukupi total harga.'])
                ->withInput();
        }
    
        $kembalian = $validated['Pembayaran'] - $totalHarga;
        $kasir = auth()->user()->name ?? 'Kasir Tidak Diketahui';

        $penjualan = Penjualan::create([
            'PelangganID' => $validated['PelangganID'],
            'TanggalPenjualan' => $validated['TanggalPenjualan'], // Menggunakan tanggal yang dipilih
            'TotalHarga' => $totalHarga,
            'Pembayaran' => $validated['Pembayaran'],
            'Kembalian' => $kembalian,
            'Kasir' => $kasir, // Menggunakan nama kasir yang sudah didapatkan
            // Tambahkan ProdukID di sini
            'ProdukID' => $produkId, // atau data yang sesuai
        ]);
        
    
        // Simpan detail penjualan
        $penjualan->details()->createMany($penjualanDetail);
        $profile = Profile::first(); // Pastikan tabel 'profiles' memiliki data

        // **Kirim Email ke Pelanggan**
    if ($penjualan->pelanggan && $penjualan->pelanggan->Email) {
        Mail::to($penjualan->pelanggan->Email)->send(new StrukEmail($penjualan, $profile));
    }
        return redirect()->route('penjualans.show', $penjualan->PenjualanID)->with('success', 'Penjualan berhasil dibuat.');
    }
    

    public function show($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'details.produk'])->find($id);

        if (!$penjualan) {
            return redirect()->route('penjualans.index')->with('error', 'Penjualan tidak ditemukan.');
        }

        $profile = Profile::first();


        return view('penjualans.show', compact('penjualan','profile'));
    }

   


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'PelangganID' => 'required|integer|exists:pelanggans,id',
            'TanggalPenjualan' => 'required|date',
            'TotalHarga' => 'required|numeric|min:0',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update($validatedData);

        return redirect()->route('penjualans.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $penjualan = penjualan::findOrFail($id);
        $penjualan->delete();
    
        return redirect()->route('penjualans.index')->with('success', 'Data Berhasil Dihapus.');
    }
    
    
    public function exportPenjualansPDF(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
    
        // Ambil data penjualan berdasarkan tanggal
        $penjualans = Penjualan::whereBetween('TanggalPenjualan', [$tanggalAwal, $tanggalAkhir])
            ->get();
    
        // Jika tidak ada data dalam rentang tanggal, tampilkan pesan error
        if ($penjualans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data dalam rentang tanggal yang dipilih.');
        }

        $profile = Profile::first();
    
        // Load view ke PDF
        $pdf = PDF::loadView('penjualans.laporan', compact('penjualans','profile'));
    
        return $pdf->download('Laporan Penjualan.pdf');
    }
    
    
    
}   