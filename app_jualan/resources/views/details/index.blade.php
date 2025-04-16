<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table th {
            background-color: #5d87ff;
            color: white;
            text-align: center;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Laporan Penjualan</h2>
        
        <form action="{{ route('details.index') }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <a href="{{ route('details.download_pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-danger w-100">
                    <i class="fa fa-file-pdf"></i> Download PDF
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Kasir</th>
                        <th>Total Pembayaran</th>
                        <th>Jumlah Kembalian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
    @if(isset($penjualans) && count($penjualans) > 0)
        @foreach($penjualans as $penjualan)
            <tr>
                <td class="text-center">{{ $penjualan->PenjualanID }}</td>
                <td>{{ optional($penjualan->kasir)->NamaKasir ?? '-' }}</td>
                <td class="text-end">Rp{{ number_format($penjualan->TotalPembayaran, 2, ',', '.') }}</td>
                <td class="text-end">Rp{{ number_format($penjualan->JumlahKembalian, 2, ',', '.') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($penjualan->TanggalPembelian)->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" class="text-center">Tidak ada data penjualan</td>
        </tr>
    @endif
</tbody>

            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
