<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use PDF; // Pastikan menggunakan Barryvdh/Dompdf

class StrukController extends Controller
{
    public function cetakStruk($penjualanId)
    {
        // Ambil data penjualan berdasarkan ID
        $penjualan = Penjualan::with(['pelanggan', 'details.produk']) // Memuat relasi pelanggan dan detail produk
            ->findOrFail($penjualanId);

        // Render HTML struk penjualan
        return view('struk.show', compact('penjualan'));
    }

    public function downloadStruk($penjualanId)
    {
        // Ambil data penjualan berdasarkan ID
        $penjualan = Penjualan::with(['pelanggan', 'details.produk']) // Memuat relasi pelanggan dan detail produk
            ->findOrFail($penjualanId);

        // Render HTML ke PDF
        $pdf = PDF::loadView('struk.show', compact('penjualan'));

        // Unduh PDF langsung
        return $pdf->download('struk-penjualan.pdf');
    }
}

