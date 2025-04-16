<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/Savelle.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/themify-icons/0.0.0/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background-color: #f0f8ff; /* Light blue background */
      margin: 0;
      padding: 0;
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    .page-wrapper {
      background-color: #e3f2fd; /* Lighter blue background */
      padding-top: 60px; /* Sesuaikan dengan tinggi header Anda */
    }

    .content-wrapper {
  flex: 1;
  padding: 20px;
  margin-left: 270px; /* Sesuaikan dengan lebar sidebar */
  margin-right: 20px;
  overflow-x: auto; /* Mencegah konten melampaui batas */
}

    .sidebar {
      position: fixed;
      top: 60px; /* Sesuaikan dengan tinggi header */
      bottom: 0;
      left: 0;
      width: 250px; /* Sesuaikan dengan lebar sidebar */
      background-color: #f8f9fa;
      z-index: 1000;
    }

    .sidebar-nav {
      background-color: #ffffff; /* Blue color for sidebar */
    }

    .sidebar-link {
      color: #ffffff; /* White text for sidebar links */
    }

    .sidebar-link:hover {
      background-color: #1976d2; /* Darker blue on hover */
    }

    .btn-primary {
      background-color: #1976d2; /* Blue button */
      border-color: #1976d2; /* Blue border */
    }

    .btn-primary:hover {
      background-color: #1565c0; /* Darker blue on hover */
      border-color: #1565c0; /* Darker blue border */
    }

    .card {
      background-color: #ffffff;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
      border: 1px solid #1976d2; /* Blue border for cards */
    }

    .card-title {
      color: #1976d2; /* Blue color for card titles */
    }

    .hover-effect:hover {
      background-color: rgb(243, 244, 246); /* Warna abu-abu terang untuk efek hover */
      transform: scale(1.01); /* Sedikit membesar pada hover */
      transition: background-color 0.2s, transform 0.2s; /* Transisi yang lebih cepat */
    }

    .table {
      font-size: 0.75rem; /* Ukuran font untuk tabel */
    }

    th,
    td {
      padding: 0.5rem 0.75rem; /* Mengurangi padding pada sel tabel */
    }

    .new-row {
      background-color: rgb(240, 226, 226); /* Warna latar biru muda untuk baris baru */
      border-left: 3px solid #3b82f6; /* Border kiri biru untuk menyorot baris baru */
    }

    .link-text {
      color: #3b82f6; /* Warna biru untuk tautan */
      text-decoration: underline; /* Garis bawah pada tautan */
      font-size: 0.75rem; /* Ukuran font untuk tautan */
    }

    .left-sidebar {
      position: fixed; /* Memastikan sidebar tetap berada di posisi tetap */
      z-index: 1050; /* Z-index lebih tinggi dari header dan konten */
      background-color: #ffffff;
      color: #2196f3;
      width: 250px; /* Atur lebar sidebar sesuai kebutuhan */
      height: 100vh; /* Pastikan sidebar memanjang hingga bawah halaman */
    }

    .container {
  margin-left: 270px; /* Memberikan jarak sesuai dengan lebar sidebar */
  padding-left: 20px; /* Jarak dari sidebar */
  padding-right: 20px; /* Memberikan ruang di kanan */
}

.content-container {
        position: relative;
        z-index: 1;
        background: white;
        padding: 20px;
        margin-left: 260px; /* Sesuaikan dengan lebar sidebar */

    }
    .content {
    margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
    padding: 20px;
}

.profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }


  </style>
</head>

<body>


<!-- nav -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <div class="d-flex align-items-center ms-auto">
      @if(Auth::check()) 
        @if(Auth::user()->role == 'admin')
          <div class="dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-user"></i> Profil</a></li>
            </ul>
          </div>
        @else
          <span class="nav-link">Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
        @endif
      @endif
    </div>
  </div>
</nav>




<!-- end navbar -->

<!-- content -->

        <!-- PERINGATAN -->
        <div class="container mt-4">
    <div class="row">
        <!-- KOLOM KIRI: TABEL PERINGATAN + GRAFIK PENJUALAN -->
        <div class="col-md-8">
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'user')
                @if($produkStokRendah->isNotEmpty() || $produkKedaluwarsa->isNotEmpty())
                <div class="card border-danger shadow-lg mb-3">
    <div class="card-header text-white text-center" style="background-color: #FF8000;">
        <h4 class="mb-0"><strong>⚠ PERHATIAN: STOK RENDAH & PRODUK KEDALUWARSA!</strong></h4>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
            <table class="table table-bordered text-center">
                <thead class="text-white" style="background-color: #FF8000;">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Kedaluwarsa</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                      $produkList = collect($produkStokRendah)->merge($produkKedaluwarsa)->unique('NamaProduk');
                      $hariIni = \Carbon\Carbon::now();
                      $no = 1;
                  @endphp
                  @foreach($produkList as $produk)
                      @php
                          $stokClass = $produk->Stok <= 5 ? 'fw-bold' : 'text-black';
                          $expClass = $produk->exp_date && \Carbon\Carbon::parse($produk->exp_date)->diffInDays($hariIni) <= 7 ? 'fw-bold' : 'text-black';
                      @endphp
                      <tr style="background-color: #D9D9D9; color: black;">
                          <td>{{ $no++ }}</td>
                          <td class="text-start fw-bold">{{ $produk->NamaProduk }}</td>
                          <td class="{{ $stokClass }}" style="color: {{ $produk->Stok <= 5 ? '#D60000' : 'black' }};">
                              {{ $produk->Stok }}
                          </td>
                          <td class="{{ $expClass }}" style="color: {{ $produk->exp_date && \Carbon\Carbon::parse($produk->exp_date)->diffInDays($hariIni) <= 7 ? '#D60000' : 'black' }};">
                              {{ $produk->exp_date ? \Carbon\Carbon::parse($produk->exp_date)->format('d-m-Y') : '-' }}
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              
            </table>
        </div>
    </div>
</div>

                @endif
            @endif

            @if(Auth::user()->role === 'admin')
                <!-- GRAFIK PENJUALAN (Hanya untuk Admin) -->
                <div class="card shadow-lg border-0">
    <div class="card-header" style="background-color: #5D87FF; text-align: center;">
        <h5 class="mb-0 text-white">Grafik Penjualan</h5>
    </div>
    <div class="card-body">
        <canvas id="chartPenjualan" style="width: 100%; height: 300px;"></canvas>
    </div>
</div>
            @endif
        </div>

        <!-- KOLOM KANAN -->
        <div class="col-md-4">
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'user')
                <!-- BEST SELLER (Bisa diakses oleh Admin & User) -->
                <div class="card mb-3 shadow-lg">
    <div class="card-header text-center text-white" style="background-color: #5D87FF;">
    <h5 class="mb-0" style="color: white;">Best Seller</h5>
    </div>
    <div class="card-body p-3">
        <table class="table table-hover table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Nama Produk</th>
                    <th class="text-center">Total Terjual</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bestSellers as $item)
                    <tr>
                        <td>{{ $item->NamaProduk }}</td>
                        <td class="text-center">
                            <span class="badge text-white" style="background-color: #5D87FF;">
                                {{ $item->total_terjual }} terjual
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
            @endif

            @if(Auth::user()->role === 'admin')
                <!-- KELOLA KASIR (Hanya untuk Admin) -->
                <div class="card text-center shadow-lg border-0">
                    <div class="card-body">
                        <i class="fas fa-user-tie fa-3x text-info mb-3"></i> 
                        <h4 class="text-info">{{ $jumlahKasir }} Kasir</h4> 
                    </div>
                    <div class="card-footer bg-primary">
                        <a href="{{ route('kassir.index') }}" class="text-white fw-bold">Kelola Kasir</a>
                    </div>
                </div>

                <!-- TOTAL SELURUH TRANSAKSI (Hanya untuk Admin) -->
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan Seluruh Transaksi</h5>
                        <h3 class="font-weight-bold text-success">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- SCRIPT GRAFIK PENJUALAN -->
@if(Auth::user()->role === 'admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var labels = @json($labels);
        var data = @json($data);

        console.log("Labels:", labels);
        console.log("Data:", data);

        var ctx = document.getElementById('chartPenjualan').getContext('2d');
        var chartPenjualan = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Pendapatan per Bulan',
                    data: data,
                    backgroundColor: 'rgba(93, 135, 255, 0.7)',
                    borderColor: 'rgba(93, 135, 255, 1)',

                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endif






<!-- end content -->



  <!-- SIDEBAR -->
  <aside class="left-sidebar">
<!-- Sidebar scroll -->
<div class="brand-logo d-flex flex-column align-items-center justify-content-center">
    <img src="{{ optional($profile)->logo ? asset('storage/' . $profile->logo) : asset('images/default-logo.png') }}" 
         alt="Logo Toko" class="profile-img rounded-circle" width="100" height="100" style="object-fit: cover;">
    
    <!-- Nama Toko di bawah Logo -->
    <span class="mt-2 fw-bold text-center">{{ optional($profile)->nama_toko ?? 'Nama Toko Default' }}</span>
</div>



    <!-- Sidebar navigation -->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul class="nav flex-column">
    @if(Auth::user()->role === 'admin')
    <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">Home</span>
    </li>

    <li class="sidebar-item mb-0">
  <a class="sidebar-link" href="home" aria-expanded="false">
    <span>
      <i class="ti ti-home"></i>
    </span>
    <span class="hide-menu">Dashboard</span>
  </a>
</li>

<li class="nav-small-cap mt-1">
  <i class="ti ti-dots nav-small-cap-icon fs-3"></i>
  <span class="hide-menu">ALL FORM</span>
</li>


<li class="sidebar-item">
      <a class="sidebar-link" href="pelanggans" aria-expanded="false">
        <span>
          <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">Pelanggan</span>
      </a>
    </li>
    
    <li class="sidebar-item">
      <a class="sidebar-link" href="supliers" aria-expanded="false">
        <span>
          <i class="ti ti-truck"></i>
        </span>
        <span class="hide-menu">Supplier</span>
      </a>
    </li>

    <li class="sidebar-item">
      <a class="sidebar-link" href="categories" aria-expanded="false">
        <span>
        <i class="fas fa-layer-group"></i>
        </span>
        <span class="hide-menu">Category</span>
      </a>
    </li>

    <li class="sidebar-item">
      <a class="sidebar-link" href="produks" aria-expanded="false">
        <span>
          <i class="ti ti-box"></i>
        </span>
        <span class="hide-menu">Produk</span>
      </a>
    </li>
    
    <li class="sidebar-item">
      <a class="sidebar-link" href="penjualans" aria-expanded="false">
        <span>
          <i class="ti ti-shopping-cart"></i>
        </span>
        <span class="hide-menu">Penjualan</span>
      </a>
    </li>


    <li class="nav-small-cap mt-1">
          <i class="ti ti-dots nav-small-cap-icon fs-3"></i>
          <span class="hide-menu">LAPORAN</span>
        </li>


        <li class="sidebar-item">
          <a class="sidebar-link" href="laporan" aria-expanded="false">
            <span>
              <i class="fas fa-chart-bar"></i>
            </span>
            <span class="hide-menu">Laporan Penjualan</span>
          </a>
        </li>



<li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">PENGATURAN</span>
    </li>
<li class="sidebar-item">
<a class="sidebar-link" href="#" onclick="document.getElementById('logout-form').submit();" aria-expanded="false">
    <span><i class="fas fa-sign-out-alt"></i></span>
    <span class="hide-menu">Keluar</span>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
   
  </a>
</li>


    @else
        {{-- Sidebar untuk kasir/user --}}

        <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">Home</span>
    </li>
    <li class="sidebar-item mb-0">
  <a class="sidebar-link" href="home" aria-expanded="false">
    <span>
      <i class="ti ti-home"></i>
    </span>
    <span class="hide-menu">Dashboard</span>
  </a>
</li>
<li class="nav-small-cap mt-1">
  <i class="ti ti-dots nav-small-cap-icon fs-3"></i>
  <span class="hide-menu">ALL FORM</span>
</li>


<li class="sidebar-item">
      <a class="sidebar-link" href="pelanggans" aria-expanded="false">
        <span>
          <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">Pelanggan</span>
      </a>
    </li> 

    <li class="sidebar-item">
      <a class="sidebar-link" href="produks" aria-expanded="false">
        <span>
          <i class="ti ti-box"></i>
        </span>
        <span class="hide-menu">Produk</span>
      </a>
    </li>
    
    <li class="sidebar-item">
      <a class="sidebar-link" href="penjualans" aria-expanded="false">
        <span>
          <i class="ti ti-shopping-cart"></i>
        </span>
        <span class="hide-menu">Penjualan</span>
      </a>
    </li>

    <li class="nav-small-cap mt-1">
          <i class="ti ti-dots nav-small-cap-icon fs-3"></i>
          <span class="hide-menu">LAPORAN</span>
        </li>


        <li class="sidebar-item">
          <a class="sidebar-link" href="laporan" aria-expanded="false">
            <span>
              <i class="fas fa-chart-bar"></i>
            </span>
            <span class="hide-menu">Laporan Penjualan</span>
          </a>
        </li>


        
    <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">PENGATURAN</span>
    </li>
<li class="sidebar-item">
<a class="sidebar-link" href="#" onclick="document.getElementById('logout-form').submit();" aria-expanded="false">
    <span><i class="fas fa-sign-out-alt"></i></span>
    <span class="hide-menu">Keluar</span>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
   
  </a>
</li>
    @endif
</ul>


    </nav>
    <!-- End Sidebar navigation -->
  </aside>
  <!-- End Sidebar -->

  


  <!-- Scripts -->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>