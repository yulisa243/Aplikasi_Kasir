<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard admin</title>
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/savelle.png') }}" />
  <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
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
    margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
}

.content-wrapper {
   flex: 1;
   margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
   padding: 20px;
   margin-right: 20px; /* Memberikan jarak di sebelah kanan */
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
    padding-top: 20px; /* Memberikan sedikit ruang agar tidak terlalu mepet */
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
  background-color:rgb(243, 244, 246); /* Warna abu-abu terang untuk efek hover */
  transform: scale(1.01); /* Sedikit membesar pada hover */
  transition: background-color 0.2s, transform 0.2s; /* Transisi yang lebih cepat */
}

.table {
  font-size: 0.75rem; /* Ukuran font untuk tabel */
}

th, td {
  padding: 0.5rem 0.75rem; /* Mengurangi padding pada sel tabel */
}

.new-row {
  background-color:rgb(240, 226, 226); /* Warna latar biru muda untuk baris baru */
  border-left: 3px solid #3b82f6; /* Border kiri biru untuk menyorot baris baru */
}

.link-text {
  color: #3b82f6; /* Warna biru untuk tautan */
  text-decoration: underline; /* Garis bawah pada tautan */
  font-size: 0.75rem; /* Ukuran font untuk tautan */
}

.left-sidebar {
    position: fixed; /* Sidebar tetap di posisi */
    top: 0; /* Pastikan sidebar menempel ke atas */
    left: 0; /* Pastikan sidebar menempel ke kiri */
    width: 250px; /* Atur lebar sidebar */
    height: 100vh; /* Sidebar memenuhi seluruh tinggi layar */
    background-color: #ffffff;
    color: #2196f3;
    z-index: 1050; /* Pastikan sidebar selalu di atas elemen lain */
    padding-top: 10px; /* Sesuaikan jarak dari atas */
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
   
        <!-- SIDEBAR -->
        <aside class="left-sidebar">
    <!-- Sidebar scroll -->
    <div class="brand-logo d-flex flex-column align-items-center justify-content-center">
        <img src="{{ optional($profile)->logo ? asset('storage/' . $profile->logo) : asset('images/default-logo.png') }}" 
             alt="Logo Toko" class="profile-img">
        
        <!-- Nama Toko di bawah Logo -->
        <span class="mt-2 fw-bold text-center">{{ optional($profile)->nama_toko ?? 'Nama Toko Default' }}</span>
    </div>

     <!-- Sidebar navigation -->
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
  <ul id="sidebarnav">
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

  </ul>
</nav>
<!-- End Sidebar navigation -->

               <!-- Scripts -->
      <script src="{{ asset ('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset ('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset ('assets/js/sidebarmenu.js')}}"></script>
  <script src="{{ asset ('assets/js/app.min.js')}}"></script>
  <script src="{{ asset ('assets/libs/apexcharts/dist/apexcharts.min.')}}"></script>
  <script src="{{ asset ('assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{ asset ('assets/js/dashboard.js')}}"></script>
  <script src="https://cdn.tailwindcss.com"></script>

</body>
  </html>
