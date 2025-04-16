@extends(auth()->user()->role == 'admin' ? 'layout_admin.sidebar' : 'layout_kasir.sidebar')


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Laporan Penjualan</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/Savelle.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        
        @media print {
        @page {
            size: A4 landscape;
            margin: 10mm;
        }
        
        body {
            transform: rotate(0deg);
        }
                
        .table {
            width: 100%;
        }
            
        }

        h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table th {
            background-color: #5d87ff !important;
            color: white;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .table tbody tr {
            background-color: white !important;
        }


        .text-left {
            text-align: left !important;
            padding-left: 15px;
        }

        .text-right {
            text-align: right !important;
            padding-right: 15px;
        }

        .rounded-table {
            border-radius: 8px;
            overflow: hidden;
        }

        
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold"></a>
  
      <div class="d-flex align-items-center ms-auto">
        @if(Auth::check())  <!-- Mengecek apakah pengguna sudah login -->
          <span class="me-3"><strong>{{ Auth::user()->name }}</strong></span>
        @else
          <span class="me-3">Selamat datang, <strong>Pengguna Tidak Dikenal</strong></span>
        @endif
      </div>
    </div>
  </nav>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Laporan Data Penjualan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.export') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">Download</button>
                    </div>
                </div>
            </form>

          
        </div>
    </div>
</div>
</body>

</html>

