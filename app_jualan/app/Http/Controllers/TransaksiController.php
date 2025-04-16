<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StrukEmail;
use App\Models\Transaksi;
use App\Models\Pelanggan;

class TransaksiController extends Controller
{
    public function checkout(Request $request)
{
    // ✅ Validasi Input
    $request->validate([
        'PelangganID' => 'required|exists:pelanggans,PelangganID',
        'TotalHarga' => 'required|numeric|min:1',
        'items' => 'required|array',
        'items.*.NamaProduk' => 'required|string|max:255',
        'items.*.JumlahProduk' => 'required|integer|min:1',
        'items.*.Harga' => 'required|numeric|min:1',
    ]);

    // ✅ Cari pelanggan
    $pelanggan = Pelanggan::find($request->PelangganID);
    if (!$pelanggan) {
        return back()->with('error', 'Pelanggan tidak ditemukan.');
    }

    if (!$pelanggan->email) {
        return back()->with('error', 'Email pelanggan tidak tersedia.');
    }

    // ✅ Simpan transaksi
    $transaksi = Transaksi::create([
        'PelangganID' => $pelanggan->PelangganID, // Sesuaikan dengan nama kolom di DB
        'TotalHarga' => $request->TotalHarga,
    ]);

    // ✅ Simpan detail transaksi (items)
    foreach ($request->items as $item) {
        $transaksi->details()->create([
            'NamaProduk' => $item['NamaProduk'], // Perbaiki dari 'nama_produk'
            'JumlahProduk' => $item['JumlahProduk'], // Perbaiki dari 'jumlah'
            'Harga' => $item['Harga'], // Perbaiki dari 'harga'
        ]);
    }

    // ✅ Kirim email struk
    try {
        Mail::to($pelanggan->email)->send(new StrukEmail($transaksi));
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Pembelian berhasil, struk dikirim ke email!');
}

}
