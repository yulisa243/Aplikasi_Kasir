<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Penjualan</title>
    <link rel="icon" type="image/png" href="../assets/images/globall.jpeg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
               .card-header-custom {
            background-color: #5d87ff;
            color: white;
        }
        .form-control {
            border-radius: 0.375rem;
        }
        .btn-custom {
            background-color: #5d87ff;
            color: white;
            border-radius: 0.375rem;
        }
        .btn-custom:hover {
            background-color: #4b75d7;
        }
    </style>
</head>
<body>
    ]
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold"></a>
    <div class="d-flex align-items-center ms-auto">
      <span class="me-3"> <strong>{{ Auth::user()->name }}</strong></span>
    </div>
  </div>
</nav>


@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header card-header-custom text-center">
                <h5>Ubah Data Penjualan</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('penjualans.update', $penjualan->PenjualanID) }}">
                    @csrf
                    @method('PUT')

                    <!-- Pelanggan -->
                    <div class="form-group mb-3">
                        <label for="PelangganID">Suplier</label>
                        <select name="PelangganID" id="PelangganID" class="form-control" required>
                            <option value="" disabled>Pilih Pelanggan</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->PelangganID }}" 
                                    @if($pelanggan->PelangganID == $penjualan->PelangganID) selected @endif>
                                    {{ $pelanggan->NamaPelanggan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Produk -->
                    <div class="form-group mb-3">
                        <label for="TanggalPenjualan">Tanggal Penjualan</label>
                        <input type="text" name="TanggalPenjualan" id="TanggalPenjualan" class="form-control" value="{{ old('TanggalPenjualan', $penjualan->TanggalPenjualan) }}" required>
                    </div>

                    <!-- Harga -->
                    <div class="form-group mb-3">
                        <label for="TotalHarga">Total Harga</label>
                        <input type="number" name="TotalHarga" id="TotalHarga" class="form-control" step="0.01" value="{{ old('TotalHarga', $penjualan->TotalHarga) }}" required>
                    </div>

                    <div class="form-group d-flex justify-content-start">
    <a href="{{ route('penjualans.index') }}" class="btn btn-custom mr-2">Kembali</a>
    <button type="submit" class="btn btn-custom">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
