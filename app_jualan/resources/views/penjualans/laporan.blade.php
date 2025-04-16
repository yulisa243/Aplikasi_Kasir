<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pelanggan</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f4f4;
}

.container {
    width: 90%;
    max-width: 1200px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

        .header {
            text-align: right;
            margin-bottom: 10px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            min-width: 600px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            white-space: nowrap;
        }
        th {
            background-color: #5d87ff;
            color: white;
        }
        .text-left {
            text-align: left;
        }
        .produk-container {
            padding: 5px 10px;
            border-top: 1px solid black;
        }
        .produk-header {
            font-weight: bold;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .header {
                text-align: center;
            }
            .table-responsive {
                width: 100%;
                overflow-x: auto;
            }
            table {
                font-size: 12px;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            th, td {
                padding: 6px;
            }
            ul {
                padding-left: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <p>{{ $profile->alamat ?? 'Alamat tidak tersedia' }}</p>
        <p>{{ $profile->no_telp ?? '-' }}</p>
    </div>

    <h3 align="center">Laporan Data Pelanggan</h3>
    <p class="text-left">Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d-m-Y') }}</p>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kasir</th>
                    <th>Nama Pelanggan</th>
                    <th>Pembayaran</th>
                    <th>Kembalian</th>
                    <th>Total Harga</th>
                    <th>Tanggal Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans as $index => $penjualan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $penjualan->Kasir ?? 'Tidak Ditemukan' }}</td>
                    <td>{{ $penjualan->pelanggan->NamaPelanggan ?? 'Tidak Ditemukan' }}</td>
                    <td>Rp {{ number_format($penjualan->Pembayaran ?? 0, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($penjualan->Kembalian ?? 0, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($penjualan->TotalHarga ?? 0, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td colspan="7" class="produk-container text-left">
                        <div class="produk-header"><strong>Produk:</strong></div>
                        <ul>
                            @php $totalProduk = 0; @endphp
                            @foreach ($penjualan->details as $detail)
                            @php
                                $namaProduk = optional($detail->produk)->NamaProduk ?? 'Produk Tidak Ditemukan';
                                $jumlah = $detail->JumlahProduk;
                                $harga = optional($detail->produk)->Harga ?? 0;
                                $subtotal = $jumlah * $harga;
                                $totalProduk += $jumlah;
                            @endphp
                            <li>{{ $namaProduk }} - {{ $jumlah }} x Rp. {{ number_format($harga, 0, ',', '.') }} = Rp. {{ number_format($subtotal, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                        <strong>Jumlah Produk:</strong> {{ $totalProduk }} Produk
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
