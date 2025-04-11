@extends('admin.template')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Supplier</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
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
        <div class="card-header card-header-custom text-center" style="background-color: #5d87ff;">
    <h5 class="text-white">Tambah Data Supplier</h5>
</div>
                <form method="POST" action="{{ route('supliers.store') }}">
                    @csrf

                    <!-- Nama Suplier -->
                    <div class="form-group">
                        <label for="SuplierNama">Supplier</label>
                        <input type="text" name="SuplierNama" id="SuplierNama" class="form-control" required>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="form-group d-flex justify-content-start">
    <a href="{{ route('supliers.index') }}" class="btn btn-custom mr-2">Kembali</a>
    <button type="submit" class="btn btn-custom">Simpan</button>
</div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>