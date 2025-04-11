<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\models\Profile;
class LaporanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::select('Kasir', 'TanggalPenjualan', 'TotalHarga')
            ->orderByDesc('TanggalPenjualan')
            ->get();

        $totalPendapatan = $penjualans->sum('TotalHarga');

        return view('laporan.index', compact('penjualans', 'totalPendapatan'));
    }

    public function export(Request $request)
    {
        $penjualans = Penjualan::whereBetween('TanggalPenjualan', [$request->start_date, $request->end_date])->get();
        
        // Debugging: Cek apakah data ada
        if ($penjualans->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan dalam rentang tanggal tersebut.');
        }

        $profile = Profile::first(); // Ambil data profil dari tabel Profile


        
        $pdf = Pdf::loadView('laporan.pdf', compact('penjualans','profile'));
        
        return $pdf->download('Laporan Penjualan.pdf');
    }
    
    
}
