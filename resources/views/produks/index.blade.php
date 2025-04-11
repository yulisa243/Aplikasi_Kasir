<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Gaya header tabel agar teks berada di tengah */
        .table thead th {
            background-color: #5d87ff;
            color: white;
            text-align: center;
            vertical-align: middle;
        }

        /* Tengahkan isi kolom dalam tabel */
        .table tbody td {
            text-align: center;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #e0eaff; /* Warna saat hover untuk baris tabel */
        }
        .table td, .table th {
            border: 1px solid #ddd;
        }
        .btn-custom {
            background-color: #5d87ff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #4b75d7;
        }

        /* Gaya untuk border tabel */
        .table-bordered {
        border: 1px solid #5d87ff;

        }

        /* Gaya tombol */
        .btn-custom {
        background-color: #5d87ff;
        color: white;

        }
            
        .btn-danger {
        background-color: #dc3545 !important; /* Warna merah Bootstrap */
        border-color: #dc3545 !important;
        color: white !important;
        
        }

        .btn-danger:hover {
        background-color: #c82333 !important; /* Warna merah lebih gelap saat hover */
        border-color: #bd2130 !important;

        }

        /* Memberi jarak antara tombol dalam btn-group */
        .btn-group .btn {
            margin-right: 5px; /* Atur jarak antar tombol */
        }

        /* Alternatif: Jika tombol dalam satu div flex */
        .btn-group {
            display: flex;
            gap: 8px; /* Atur jarak antar tombol */
        }
        /* Pastikan elemen dalam row berada di kanan */
        .form-inline {
            display: flex;
            justify-content: flex-end; /* Pindahkan ke ujung kanan */
            width: 100%; /* Pastikan lebar form penuh */
        }

        .stok-merah {
            color: red !important;
            font-weight: red;
        }
        @media (max-width: 768px) {
    .table td {
        white-space: nowrap; /* Mencegah tombol turun ke bawah */
    }
    .d-flex {
        flex-wrap: nowrap; /* Menjaga tombol tetap sejajar */
    }
}



    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold"></a>
    <div class="d-flex align-items-center ms-auto">
      <span class="me-3"> <strong>{{ Auth::user()->name }}</strong></span>
    </div>
  </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            @if(auth()->user()->role == 'admin')
                @includeIf('layout_admin.sidebar')
            @elseif(auth()->user()->role == 'user')
                @includeIf('layout_kasir.sidebar')
            @endif
        </div>

        <div class="col-md-10">
            <div class="container mt-3">
                @if (session('success'))
                    <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Daftar Produk</h5>
                        <br>
                                <div class="row mb-3">
                                <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Tombol Tambah & Export di kiri -->
            <div class="col-md-6 d-flex gap-2">
                    <a href="{{ route('produks.create') }}" class="btn text-white" style="background-color: #5d87ff;">Tambah</a>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('produks.export-pdf') }}" class="btn text-white" style="background-color: #5d87ff;">Export</a>
                    @endif                </div>

            <!-- Input Pencarian di kanan -->
            <form action="{{ route('produks.index') }}" method="GET" class="d-flex">
    <input type="text" name="search" class="form-control me-2" placeholder="Cari Produk" value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
        </div>
    </div>


                <!-- Table for Pelanggan Data -->
                <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Nama Suplier</th>
                                <th>Category</th>
                                <th>Tanggal Kadaluarsa</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                    @foreach($produks as $produk)
                                        <tr>
                                            <td>{{ $produk->ProdukID }}</td>
                                            <td>{{ $produk->NamaProduk }}</td>
                                            <td>Rp. {{ number_format($produk->Harga, 0, ',', '.') }}</td>

                                            <td class="{{ $produk->Stok <= 5 ? 'stok-merah' : '' }}">
                                                {{ $produk->Stok }}
                                            </td>
                                            <td>{{ optional($produk->suplier)->SuplierNama ?? '-' }}</td>
                                            <td>{{ optional($produk->category)->CategoryName ?? '-' }}</td>
                                            <td class="{{ \Carbon\Carbon::parse($produk->exp_date)->diffInDays(now()) <= 7 ? 'stok-merah' : '' }}">
                                                {{ $produk->exp_date ? date('d-m-Y', strtotime($produk->exp_date)) : '-' }}
                                                @if(\Carbon\Carbon::parse($produk->exp_date)->diffInDays(now()) <= 7)
                                                    <span class="badge badge-danger ml-2">Segera Kedaluwarsa!</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center gap-1">
    <a href="{{ route('produks.edit', $produk->ProdukID) }}" class="btn btn-warning btn-sm" title="Edit">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('produks.destroy', $produk->ProdukID) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- Akhir table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
