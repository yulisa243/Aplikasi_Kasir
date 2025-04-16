@extends('layout_admin.sidebar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Produk</title>
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/savelle.png') }}?v={{ time() }}" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        .card-header-custom {
            background-color: #5d87ff;
            color: white;
            text-align: center;
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
        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        /* Styling for the content area to ensure it doesn't overlap with the sidebar */
        .content-wrapper {
            margin-left: 250px; /* Adjust based on sidebar width */
            padding-top: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->


<!-- Error Messages -->
@if($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
        <div class="card-header text-center" style="background-color: #5d87ff; color: white !important; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
    <h5 style="color: white !important;">Ubah Data produk</h5>
</div>
            <div class="card-body">
                <form method="POST" action="{{ route('produks.update', $produk->ProdukID) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label for="NamaProduk" class="form-label">Nama Produk</label>
                        <input type="text" name="NamaProduk" id="NamaProduk" class="form-control" value="{{ old('NamaProduk', $produk->NamaProduk) }}" required>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga</label>
                        <input type="number" name="Harga" id="Harga" class="form-control" value="{{ old('Harga', $produk->Harga) }}" step="0.01" required>
                    </div>

                    <!-- Stok -->
                    <div class="mb-3">
                        <label for="Stok" class="form-label">Stok</label>
                        <input type="number" name="Stok" id="Stok" class="form-control" value="{{ old('Stok', $produk->Stok) }}" required>
                        </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="CategoryID" class="form-label">Kategori</label>
                        <select name="CategoryID" id="CategoryID" class="form-control" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->CategoryID }}" {{ $category->CategoryID == $produk->CategoryID ? 'selected' : '' }}>{{ $category->CategoryName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Suplier -->
                    <div class="mb-3">
                        <label for="SuplierID" class="form-label">Suplier</label>
                        <select name="SuplierID" id="SuplierID" class="form-control" required>
                            <option value="" selected disabled>Pilih Suplier</option>
                            @foreach ($supliers as $suplier)
                                <option value="{{ $suplier->SuplierID }}" {{ $suplier->SuplierID == $produk->SuplierID ? 'selected' : '' }}>{{ $suplier->SuplierNama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-3">
                        <label for="exp_date" class="form-label">Expired Date</label>
                        <input type="date" name="exp_date" id="exp_date" class="form-control" value="{{ old('exp_date', $produk->exp_date) }}" step="0.01" required>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-group d-flex justify-content-start">
    <a href="{{ route('produks.index') }}" class="btn btn-custom mr-2" style="background-color: #5d87ff; color: white;">
        Kembali
    </a>
    <button type="submit" class="btn btn-custom" style="background-color: #5d87ff; color: white;">
        Ubah
    </button>
</div>

                </form>
            </div>
        </div>
    </div>
</div>

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
