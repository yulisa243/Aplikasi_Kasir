@extends(auth()->user()->role == 'admin' ? 'layout_admin.sidebar' : 'layout_kasir.sidebar')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/Savelle.png" />
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

        /* untuk radio button */
        .form-check-input {
                border-color: gray;
            }

        .form-check-input:checked {
            background-color: purple;
            border-color: purple;
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
                <div class="card-header card-header-custom text-center" style="background-color: #5d87ff;">
            <h5 class="text-white">Tambah Data pelanggan</h5>
        </div>

            <div class="card-body">
                <form method="POST" action="{{ route('pelanggans.store') }}">
                    @csrf

                    <!-- Nama Pelanggan -->
                    <div class="form-group mb-3">
                        <label for="NamaPelanggan">Nama Pelanggan</label>
                        <input type="text" name="NamaPelanggan" id="NamaPelanggan" class="form-control" value="{{ old('NamaPelanggan') }}" required>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        <label for="Alamat">Alamat</label>
                        <input type="text" name="Alamat" id="Alamat" class="form-control" value="{{ old('Alamat') }}" required>
                    </div>

                    <!-- No Telepon -->
                    <div class="form-group mb-3">
                        <label for="Notelp">No Telepon</label>
                        <input type="number" name="Notelp" id="Notelp" class="form-control" value="{{ old('Notelp') }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="Email">Email</label>
                        <input type="email" name="Email" id="Email" class="form-control" value="{{ old('Email') }}" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="card-custom">
                        <label class="fw-bold">Jenis Kelamin</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="JenisKelamin" id="laki" value="Laki-laki">
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="JenisKelamin" id="perempuan" value="Perempuan">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    </br>

                    <div class="form-group d-flex justify-content-start">
                        <a href="{{ route('pelanggans.index') }}" class="btn btn-custom mr-2">Kembali</a>
                        <button type="submit" class="btn btn-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>