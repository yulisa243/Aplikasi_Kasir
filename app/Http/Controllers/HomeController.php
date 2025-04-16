<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\Profile;
use App\Models\User; // Tambahkan ini
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
{

    $profile = Profile::first(); // Ambil data profil toko pertama


    // Ambil produk dengan stok rendah
    $produkStokRendah = Produk::where('Stok', '<=', 5)->get();

    // Definisikan satu kali saja
    $hariIni = Carbon::today(); // atau pakai Carbon::now() kalau butuh waktu juga

    // Ambil produk yang akan kedaluwarsa dalam 7 hari dari hari ini
    $produkKedaluwarsa = Produk::whereNotNull('exp_date')
    ->whereDate('exp_date', '<=', $hariIni->copy()->addDays(7))
    ->whereDate('exp_date', '>=', $hariIni)
    ->get();


     // Ambil 10 transaksi terbaru dari tabel `penjualans`
     $transaksiTerakhir = Penjualan::orderBy('TanggalPenjualan', 'desc')
     ->take(2) // Ambil 10 transaksi terakhir
     ->get();

     $kasir = User::where('role', 'user')->get();
     $jumlahKasir = User::where('role', 'user')->count();


     $totalPendapatan = Penjualan::sum('TotalHarga');

     $bestSellers = DB::table('details')
     ->join('produks', 'details.ProdukID', '=', 'produks.ProdukID') // Sesuaikan nama tabel dan field
     ->select('produks.NamaProduk', DB::raw('SUM(details.JumlahProduk) as total_terjual'))
     ->groupBy('details.ProdukID', 'produks.NamaProduk')
     ->orderByDesc('total_terjual')
     ->take(3) // Ambil 5 produk terlaris
     ->get();


     

// Ambil data dari database berdasarkan TanggalPenjualan
$penjualanPerBulan = DB::table('penjualans')
    ->selectRaw('MONTH(TanggalPenjualan) as bulan, SUM(TotalHarga) as total')
    ->groupBy('bulan')
    ->orderBy('bulan')
    ->pluck('total', 'bulan')
    ->toArray();

// Pastikan data diubah ke angka sebelum dijumlahkan
$totalPendapatan = array_sum(array_map('floatval', $penjualanPerBulan));

// Inisialisasi array bulan dengan 0
$data = array_fill(0, 12, 0);
$labels = [];

for ($i = 1; $i <= 12; $i++) {
    $labels[] = Carbon::create()->month($i)->translatedFormat('F'); // Nama bulan
    if (isset($penjualanPerBulan[$i])) {
        $data[$i - 1] = (int) $penjualanPerBulan[$i]; // Memasukkan data ke array
    }
}

$profile = Profile::first();



    return view('home', compact('produkStokRendah', 'produkKedaluwarsa','transaksiTerakhir','kasir','jumlahKasir','bestSellers','labels', 'data','totalPendapatan','profile','hariIni'));
}
}

