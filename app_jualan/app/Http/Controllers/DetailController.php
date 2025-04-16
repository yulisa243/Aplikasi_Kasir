<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Penjualan;
use App\Models\Produk;
use PDF;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    // Menampilkan laporan berdasarkan penjualan
    public function laporan(Request $request)
    {
        $tanggalMulai = $request->input('start_date');
        $tanggalAkhir = $request->input('end_date');

        // Ambil data transaksi penjualan dalam rentang tanggal yang diminta
        $penjualans = Penjualan::with(['details.produk'])
            ->whereBetween('TanggalPenjualan', [$tanggalMulai, $tanggalAkhir])
            ->get();

        // Inisialisasi array untuk menampung laporan
        $laporan = [];

        // Proses untuk mengelompokkan dan menjumlahkan jumlah produk yang sama
        foreach ($penjualans as $penjualan) {
            foreach ($penjualan->details as $detail) {
                $key = $detail->produk->NamaProduk . '-' . $penjualan->TanggalPenjualan;

                if (!isset($laporan[$key])) {
                    $laporan[$key] = [
                        'Produk' => $detail->produk->NamaProduk,
                        'TanggalPenjualan' => $penjualan->TanggalPenjualan,
                        'JumlahProduk' => $detail->JumlahProduk,
                        'Harga' => $detail->produk->Harga,
                        'Subtotal' => $detail->JumlahProduk * $detail->produk->Harga, // Hitung subtotal
                    ];
                } else {
                    $laporan[$key]['JumlahProduk'] += $detail->JumlahProduk;
                    $laporan[$key]['Subtotal'] += $detail->JumlahProduk * $detail->produk->Harga;
                }
            }
        }

        // Ubah array laporan menjadi array numerik
        $laporan = array_values($laporan);

        // Kirim data laporan ke view
        return view('laporan.penjualan', compact('laporan', 'tanggalMulai', 'tanggalAkhir'));
    }

    // Menampilkan daftar detail penjualan dengan filter tanggal
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $details = Detail::with('penjualan', 'produk')
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereHas('penjualan', function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('TanggalPenjualan', [$start_date, $end_date]);
                });
            })
            ->paginate(10); // Menggunakan paginasi

        return view('details.index', compact('details', 'start_date', 'end_date'));
    }

    // Mengekspor laporan ke PDF
    public function exportPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Ambil detail transaksi penjualan yang terfilter berdasarkan tanggal
        $details = Detail::with('produk', 'penjualan')
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereHas('penjualan', function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('TanggalPenjualan', [$start_date, $end_date]);
                });
            })
            ->get();

        // Kelompokkan data berdasarkan produk dan tanggal penjualan
        $groupedDetails = [];
        foreach ($details as $detail) {
            $key = $detail->produk->NamaProduk . '|' . $detail->penjualan->TanggalPenjualan;
            if (!isset($groupedDetails[$key])) {
                $groupedDetails[$key] = [
                    'Produk' => $detail->produk->NamaProduk,
                    'TanggalPenjualan' => $detail->penjualan->TanggalPenjualan,
                    'JumlahProduk' => $detail->JumlahProduk,
                    'Harga' => $detail->produk->Harga,
                    'Subtotal' => $detail->JumlahProduk * $detail->produk->Harga,
                ];
            } else {
                $groupedDetails[$key]['JumlahProduk'] += $detail->JumlahProduk;
                $groupedDetails[$key]['Subtotal'] += $detail->JumlahProduk * $detail->produk->Harga;
            }
        }

        // Ubah ke array numerik
        $laporan = array_values($groupedDetails);

        // Generate PDF
        $pdf = PDF::loadView('details.pdf', [
            'details' => $laporan,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ])->setPaper('a4', 'landscape');

        // Mengunduh file PDF
        return $pdf->download('Laporan_Penjualan.pdf');
    }

    // Menyimpan detail penjualan
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah_produk' => 'required|integer|min:1',
            'penjualan_id' => 'required|exists:penjualan,id',
        ]);

        // Ambil data dari request
        $produk = Produk::findOrFail($request->produk_id);
        $penjualan = Penjualan::findOrFail($request->penjualan_id);
        $jumlahProduk = $request->jumlah_produk;

        // Hitung subtotal
        $subtotal = $produk->Harga * $jumlahProduk;

        // Simpan data detail penjualan
        $detail = new Detail();
        $detail->ProdukID = $produk->id;
        $detail->PenjualanID = $penjualan->id;
        $detail->JumlahProduk = $jumlahProduk;
        $detail->save();

        return redirect()->route('penjualan.index')->with('success', 'Detail penjualan berhasil ditambahkan');
    }

    public function downloadPDF(Request $request)
    {
        $penjualans = Penjualan::whereBetween('TanggalPenjualan', [$request->start_date, $request->end_date])->get();
        
        dd($penjualans); // Periksa apakah data muncul
    
        $pdf = Pdf::loadView('details.pdf', compact('penjualans'));
    
        return $pdf->download('laporan_penjualan.pdf');
    }
    
}
