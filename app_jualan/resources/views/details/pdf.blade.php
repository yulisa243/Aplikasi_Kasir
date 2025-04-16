<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #5d87ff;
            color: white;
        }
        h2, p {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    <p><strong>Dari Tanggal:</strong> {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}</p>
    <p><strong>Sampai Tanggal:</strong> {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $key => $detail)
                @php
                    $subtotal = $detail['Harga'] * $detail['JumlahProduk'];
                @endphp
                <tr>
                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->JumlahProduk }}</td>
                                <td>{{ $detail->penjualan ? \Carbon\Carbon::parse($detail->penjualan->TanggalPenjualan)->format('d-m-Y') : 'Tidak tersedia' }}</td>
                                <td class="text-right">Rp {{ number_format($detail->produk->Harga, 2, ',', '.') }}</td>
                            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
