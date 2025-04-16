@extends('layout_admin.sidebar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kategori</title>
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/savelle.png') }}" />
    
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
    <h5 style="color: white !important;">Ubah Data Category</h5>
</div>

            <div class="card-body">
                <form method="POST" action="{{ route('categories.update', $category->CategoryID) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Category -->
                    <div class="form-group">
                        <label for="CategoryName">Nama Category</label>
                        <input type="text" name="CategoryName" id="CategoryName" class="form-control" value="{{ $category->CategoryName }}" required>
                    </div>

                    <div class="form-group d-flex justify-content-start">
                    <a href="{{ route('categories.index') }}" class="btn btn-custom mr-2" style="background-color: #5d87ff; color: white;">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-custom" style="background-color: #5d87ff; color: white;">
                        Ubah
                    </button>
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
