<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pelanggan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            margin: auto;
        }
        .header {
            text-align: right;
            margin-bottom: 10px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #5d87ff;
            color: white;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .produk-container {
            padding: 5px 10px;
            border-top: 1px solid black;
        }
        .produk-header {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Header Alamat dan No Telp -->
    <div class="header">
    <p class="text-right">{{ $profile->alamat ?? 'Alamat tidak tersedia' }}</p>
    <p class="text-right"> {{ $profile->no_telp ?? '-' }}</p>
    </div>
    </br>

    <h3 align="center">Laporan Data Pelanggan</h3>
    </br>
    <p class="text-left">Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Kasir</th>
                <th style="width: 15%;">Nama Pelanggan</th>
                <th style="width: 10%;">Pembayaran</th>
                <th style="width: 10%;">Kembalian</th>
                <th style="width: 10%;">Total Harga</th>
                <th style="width: 15%;">Tanggal Penjualan</th>
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
            <td colspan="7" class="produk-container" style="text-align: left;">
    <div class="produk-header"><strong>Produk:</strong></div>
    <ul style="padding-left: 20px; list-style-position: inside;">
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
</body>
</html>
