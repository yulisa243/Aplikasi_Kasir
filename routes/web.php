<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\StrukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});






Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


//Suplier
        Route::middleware('userAccess:admin')->group(function () {
Route::get('supliers', [SuplierController::class, 'index'])->name('supliers.index');
Route::get('supliers/create', [SuplierController::class, 'create'])->name('supliers.create');
Route::post('supliers', [SuplierController::class, 'store'])->name('supliers.store');
Route::get('supliers/{SuplierID}/edit', [SuplierController::class, 'edit'])->name('supliers.edit');
Route::put('supliers/{SuplierID}', [SuplierController::class, 'update'])->name('supliers.update');
Route::delete('supliers/{SuplierID}', [SuplierController::class, 'destroy'])->name('supliers.destroy');
Route::get('/supliers/export-pdf', [SuplierController::class, 'exportSupliersPDF'])->name('supliers.export-pdf');
});


//Categori
    Route::middleware('userAccess:admin')->group(function () {
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{CategoryID}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{CategoryID}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{CategoryID}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/export-pdf', [CategoryController::class, 'exportCategoriesPDF'])->name('categories.export-pdf');
});

//Produk
Route::get('produks', [ProdukController::class, 'index'])->name('produks.index');
Route::get('produks/create', [ProdukController::class, 'create'])->name('produks.create');
Route::post('produks', [ProdukController::class, 'store'])->name('produks.store');
Route::get('produks/{CategoryID}/edit', [ProdukController::class, 'edit'])->name('produks.edit');
Route::put('produks/{CategoryID}', [ProdukController::class, 'update'])->name('produks.update');
Route::delete('produks/{CategoryID}', [ProdukController::class, 'destroy'])->name('produks.destroy');
Route::post('/decrease-stock/{produkId}/{quantity}', [ProductController::class, 'decreaseStock']);


Route::middleware('userAccess:admin')->group(function () {
Route::get('/produks/export-pdf', [ProdukController::class, 'exportProduksPDF'])->name('produks.export-pdf');
});


//Pelanggan

Route::get('pelanggans', [PelangganController::class, 'index'])->name('pelanggans.index');
Route::get('pelanggans/create', [PelangganController::class, 'create'])->name('pelanggans.create');
Route::post('pelanggans', [PelangganController::class, 'store'])->name('pelanggans.store');
Route::get('pelanggans/{PelangganID}/edit', [PelangganController::class, 'edit'])->name('pelanggans.edit');
Route::put('pelanggans/{PelangganID}', [PelangganController::class, 'update'])->name('pelanggans.update');
Route::delete('pelanggans/{PelangganID}', [PelangganController::class, 'destroy'])->name('pelanggans.destroy');
Route::get('/pelanggans/export-pdf', [PelangganController::class, 'exportPDF'])->name('pelanggans.export-pdf');


//Penjualan
    Route::middleware('userAccess:admin,user')->group(function () {
Route::get('penjualans', [PenjualanController::class, 'index'])->name('penjualans.index');
Route::get('penjualans/create', [PenjualanController::class, 'create'])->name('penjualans.create');
Route::post('penjualans', [PenjualanController::class, 'store'])->name('penjualans.store');
Route::get('penjualans/{PenjualanID}/show', [PenjualanController::class, 'show'])->name('penjualans.show');
Route::get('/penjualans/export-pdf', [PenjualanController::class, 'exportPenjualansPDF'])->name('penjualans.export-pdf');
});

// Route::put('penjualans/{PenjualanID}', [PenjualanController::class, 'update'])->name('penjualans.update');

    Route::middleware('userAccess:admin')->group(function () {
Route::delete('penjualans/{PenjualanID}', [PenjualanController::class, 'destroy'])->name('penjualans.destroy');
});

//LAPORAN
Route::middleware('userAccess:admin,user')->group(function () {
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
Route::get('/laporan/pdf', [LaporanController::class, 'showPdf'])->name('laporan.pdf');
});



Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');




//Cetak Struk
Route::get('struk/download/{PenjualanID}', [PenjualanController::class, 'download'])->name('struk.download');

//Laporan Detail
Route::get('/details/export-pdf', [DetailController::class, 'exportPdf'])->name('details.export-pdf');


// Rute untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Route untuk menampilkan form login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login.form');

// Route untuk proses login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Route untuk logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Proteksi halaman lain agar hanya yang sudah login yang bisa mengakses
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//KASIR 
Route::get('/kassir', [KasirController::class, 'index'])->name('kassir.index');
Route::get('/kassir/{id}/edit', [KasirController::class, 'edit'])->name('kassir.edit');
Route::put('/kassir/{id}', [KasirController::class, 'update'])->name('kassir.update');
Route::delete('/kassir/{id}', [KasirController::class, 'destroy'])->name('kassir.destroy');
Route::get('kassir/{id}', [KasirController::class, 'show'])->name('kassir.show');
Route::post('/kasir/activate/{id}', [KasirController::class, 'activate'])->name('kasir.activate');


Route::middleware(['auth', 'checkIsActive'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route lainnya yang hanya bisa diakses user aktif
});


Route::put('/admin/users/{id}/activate', [AdminController::class, 'activateUser'])->name('admin.users.activate');

// Lupa Password
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

// Notif Lupa Password
Route::post('/email/verify/resend', [EmailVerificationNotificationController::class, 'store']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

    use App\Http\Controllers\Auth\NewPasswordController;
    
    // Rute untuk menampilkan form permintaan link reset password
    Route::get('forgot-password', [PasswordresetLinkController::class, 'showLinkRequestForm'])
        ->middleware('guest')
        ->name('password.request');
    
    // Rute untuk mengirimkan email link reset password
    Route::post('forgot-password', [PasswordresetLinkController::class, 'sendResetLinkEmail'])
        ->middleware('guest')
        ->name('password.email');
    
    // Rute untuk menampilkan form reset password
    Route::get('reset-password/{token}', [NewPasswordController::class, 'showResetForm'])
        ->middleware('guest')
        ->name('password.reset');
    
    // Rute untuk menangani permintaan reset password
    Route::post('reset-password', [NewPasswordController::class, 'reset'])
        ->middleware('guest')
        ->name('password.update');
    


// //Detail
// Route::get('details', [DetailController::class, 'index'])->name('details.index');
// Route::get('details/create', [DetailController::class, 'create'])->name('details.create');
// Route::post('details', [DetailController::class, 'store'])->name('details.store');
// Route::get('/details/{DetailID}/edit', [DetailController::class, 'edit'])->name('details.edit');
// Route::put('details/{DetailID}', [DetailController::class, 'update'])->name('details.update');
// Route::delete('details/{DetailID}', [DetailController::class, 'destroy'])->name('details.destroy');
// Route::get('/details/download-pdf', [DetailController::class, 'downloadPDF'])->name('details.download_pdf');
