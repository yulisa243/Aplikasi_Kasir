@extends('layout_admin.sidebar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kategori</title>
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/savelle.png') }}?v={{ time() }}" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome -->
    <style>
               .card-header-custom {
            background-color: #5d87ff;
            color: white;
        }
        .form-control {
            border-radius: 0.375rem;
        }
        .btn-custom {
            background-color: #5d87ff; /* Warna ungu */
            color: white;
            border-radius: 0.375rem;
        }
        .btn-custom:hover {
            background-color: #5d87ff;
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
        <div class="card-header text-center" style="background-color: #5d87ff; color: white !important;">
    <h5 style="color: white !important;">Ubah Kategori</h5>
</div>


        <div class="card-body">
            <form action="{{ route('kassir.update', $kasir->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $kasir->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $kasir->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $kasir->alamat) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp', $kasir->no_telp) }}">
                </div>

                <div class="form-group">
                    <label for="status">Status Pekerjaan</label>
                    <select class="form-control" id="status" name="status">
                        <option value="bekerja" {{ $kasir->status == 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                        <option value="tidak bekerja" {{ $kasir->status == 'tidak bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                    </select>
                </div>

                <div class="form-group d-flex justify-content-start flex-wrap">
                        <!-- Tombol Kembali dengan Background Biru -->
                        <a href="{{ route('home') }}" class="btn" style="background-color: #5d87ff; color: white; border-radius: 0.375rem; border: none; padding: 10px 20px; margin-right: 10px;">Kembali</a>

                        <!-- Tombol Ubah dengan Background Biru -->
                        <button type="submit" class="btn" style="background-color: #5d87ff; color: white; border-radius: 0.375rem; border: none; padding: 10px 20px;">Ubah</button>
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
