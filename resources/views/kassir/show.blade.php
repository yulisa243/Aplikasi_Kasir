<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kasir</title>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .card-profile {
            max-width: 700px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .card-header {
    background-color: #5d87ff; /* Menjaga latar belakang biru */
    color: white !important; /* Memastikan teks tetap putih */
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.card-header h5.card-title {
    color: white !important; /* Memastikan warna teks putih */
}



        .status-bekerja {
            color: green;
            font-weight: bold;
        }

        .status-tidak-bekerja {
            color: red;
            font-weight: bold;
        }

        .card-body p {
            margin-bottom: 1.25rem;
        }

        .d-flex.justify-content-between {
            margin-top: 2rem;
        }

        .btn-back {
            background-color: #5d87ff;
            color: white;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #4b75d7;
        }

        .row {
            margin-bottom: 1.5rem;
        }

        .row p {
            font-size: 1.1rem;
        }

        .container {
            padding-top: 50px;
        }
    </style>
</head>

<body>

    <div class="content-wrapper">
        <div class="container">
            <div class="card card-profile">
                <div class="card-header">
                    <h5 class="card-title">Detail Kasir</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> {{ $kasir->name }}</p>
                            <p><strong>Email:</strong> {{ $kasir->email }}</p>
                            <p><strong>Alamat:</strong> {{ $kasir->alamat }}</p>
                            <p><strong>No Telepon:</strong> {{ $kasir->no_telp }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status Pekerjaan:</strong>
                                @if($kasir->is_active)
                                    @if($kasir->status == 'bekerja')
                                        <span class="status-bekerja">Bekerja sejak {{ $kasir->created_at->format('d-m-Y') }}</span>
                                    @elseif($kasir->status == 'tidak bekerja')
                                        <span class="status-tidak-bekerja">Tidak Bekerja sejak {{ $kasir->updated_at->format('d-m-Y') }}</span>
                                    @else
                                        <span class="text-warning">Status tidak tersedia</span>
                                    @endif
                                @else
                                    <span class="text-warning">Akun belum diaktifkan</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kassir.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
