<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold"></a>

    <div class="d-flex align-items-center ms-auto">
      @if(Auth::check())  <!-- Mengecek apakah pengguna sudah login -->
        <span class="me-3"><strong>{{ Auth::user()->name }}</strong></span>
      @else
        <span class="me-3">Selamat datang, <strong>Pengguna Tidak Dikenal</strong></span>
      @endif
    </div>
  </div>
</nav>
