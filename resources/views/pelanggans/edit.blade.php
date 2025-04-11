@extends('layout_admin.sidebar')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Pelanggan</title>
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/savelle.png') }}" />
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        /* Gaya untuk header tabel */
        .table th {
            background-color: #5d87ff;
            color: white;
        }

        /* Gaya untuk baris tabel */
        .table tbody tr:hover {
            background-color: #e0eaff; /* Warna saat hover untuk baris tabel */
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

        .btn-custom:hover {
            background-color: #4b75d7;
        }

        /* Spesifikkan selector untuk tombol agar tidak terpengaruh oleh sidebar */
        .content-wrapper .btn-custom {
            background-color: #5d87ff;
            color: white;
        }

        .content-wrapper .btn-custom:hover {
            background-color: #4b75d7;
        }

        /* Menebalkan teks label, tapi tidak terlalu bold */
        .form-group label {
            font-weight: 500; /* Menurunkan ketebalan font */
        }

        /* Menentukan gaya header tabel agar tetap terlihat dengan jelas */
        .content-wrapper .table th {
            background-color: #5d87ff; /* Warna latar belakang */
            color: white; /* Warna teks */
            text-align: center; /* Menyelaraskan teks di tengah */
        }

        /* Menambahkan gaya hover untuk baris */
        .content-wrapper .table tbody tr:hover {
            background-color: #e0eaff; /* Warna saat hover pada baris tabel */
        }
        
        /* Form Styling */
        .form-control {
            border-radius: 0.375rem;
        }

        .form-section {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        .form-section h3 {
            cursor: pointer;
            color: #007bff;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .card-header-custom {
            background-color: #007bff;
            color: white;
        }

        .sidebar {
    background-color: #f8f9fa; /* Warna lebih gelap untuk sidebar */
    border-right: 2px solid #ddd; /* Garis pemisah */
    padding: 15px;
    font-size: 16px;
    font-weight: bold;
    position: fixed;
    width: 250px;
    height: 100vh;

}

     /* untuk radio button */
     .form-check-input {
        border-color: gray;
        }

        .form-check-input:checked {
            background-color: purple;
            border-color: purple;
        }


    </style>
</head>

<body>
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
            <div class="card-header text-center" style="background-color: #5d87ff; color: white !important; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
    <h5 style="color: white !important;">Ubah Data Pelanggan</h5>
</div>


                <div class="card-body">
                    <form method="POST" action="{{ route('pelanggans.update', $pelanggan->PelangganID) }}">
                        @csrf
                        @method('PUT')

                      <!-- Nama Pelanggan -->
                      <div class="form-group mb-3">
                            <label for="NamaPelanggan">Nama Pelanggan</label>
                            <input type="text" name="NamaPelanggan" id="NamaPelanggan" class="form-control" 
                                   value="{{ old('NamaPelanggan', $pelanggan->NamaPelanggan) }}" required>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group mb-3">
                            <label for="Alamat">Alamat</label>
                            <input type="text" name="Alamat" id="Alamat" class="form-control" 
                                   value="{{ old('Alamat', $pelanggan->Alamat) }}" required>
                        </div>

                        <!-- No Telepon -->
                        <div class="form-group mb-3">
                            <label for="Notelp">No Telepon</label>
                            <input type="number" name="Notelp" id="Notelp" class="form-control" 
                                   value="{{ old('Notelp', $pelanggan->Notelp) }}" required>
                        </div>

                        <!-- Email (Validasi Unik Kecuali ID Saat Ini) -->
                        <div class="form-group mb-3">
                            <label for="Email">Email</label>
                            <input type="email" name="Email" id="Email" class="form-control" 
                                   value="{{ old('Email', $pelanggan->Email) }}" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group">
                            <label class="fw-bold">Jenis Kelamin</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="JenisKelamin" id="laki" value="Laki-laki" 
                                           {{ $pelanggan->JenisKelamin == 'Laki-laki' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="laki">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="JenisKelamin" id="perempuan" value="Perempuan" 
                                           {{ $pelanggan->JenisKelamin == 'Perempuan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-group d-flex justify-content-start">
                            <a href="{{ route('pelanggans.index') }}" class="btn btn-custom mr-2">Kembali</a>
                            <button type="submit" class="btn btn-custom">Ubah</button>
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
