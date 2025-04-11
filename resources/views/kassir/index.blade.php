@extends('admin.template')


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kasir</title>
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

.btn-danger {
    background-color: #dc3545 !important; /* Warna merah Bootstrap */
    border-color: #dc3545 !important;
    color: white !important;
}

.btn-danger:hover {
    background-color: #c82333 !important; /* Warna merah lebih gelap saat hover */
    border-color: #bd2130 !important;
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

<div class="content-wrapper">
    <div class="container mt-5">
        @if (session('success'))
            <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Daftar kasir</h5>
                <div class="row mb-3">

                </div>
                <div class="table-container">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-blue">
                            <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kasir as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->name }}</td>
                            <td>{{ $k->email }}</td>
                            <td>
    <div class="btn-group">
        <a href="{{ route('kassir.edit', $k->id) }}" class="btn btn-warning btn-sm mr-2" title="Edit">
            <i class="fas fa-edit"></i>
        </a>
        <!-- Tombol Hapus -->
        <form action="{{ route('kassir.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Data Ini Akan Dihapus?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    </div>
                               
</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
