<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
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
        .stok-merah {
            color: red;
            font-weight: bold;
        }

        .expired {
    color: white;
    background-color: red;
    padding: 2px 4px; /* Kurangi padding */
    border-radius: 3px; /* Perhalus sudut */
    font-size: 10px; /* Perkecil ukuran font */
    line-height: 1; /* Kurangi tinggi baris */
    display: inline-block; /* Mencegah pemisahan baris */
    white-space: nowrap; /* Mencegah teks turun ke bawah */
}
.text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container">
<p class="text-right">{{ $profile->alamat ?? 'Alamat tidak tersedia' }}</p>
<p class="text-right"> {{ $profile->no_telp ?? '-' }}</p>


    </br>
    <h3 align="center">Laporan Data Produk</h3>
    </br>
    <p class="text-left">Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 40%;">Nama Produk</th>
                        <th style="width: 15%;">Harga</th>
                        <th style="width: 10%;">Stok</th>
                        <th style="width: 20%;">Nama Supplier</th>
                        <th style="width: 15%;">Kategori</th>
                        <th style="width: 15%;">Tanggal Kedaluwarsa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produks as $index => $produk)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-left">{{ $produk->NamaProduk }}</td>
                        <td class="text-center">{{ number_format($produk->Harga, 2, ',', '.') }}</td>
                        <td class="text-center {{ $produk->Stok <= 6 ? 'stok-merah' : '' }}">{{ $produk->Stok }}</td>
                        <td class="text-left">{{ $produk->suplier->SuplierNama }}</td>
                        <td class="text-center">{{ $produk->category->CategoryName }}</td>
                        <td class="text-center {{ \Carbon\Carbon::parse($produk->exp_date)->diffInDays(now()) <= 7 ? 'stok-merah' : '' }}">
                            {{ $produk->exp_date ? date('d-m-Y', strtotime($produk->exp_date)) : '-' }}
                            @if(\Carbon\Carbon::parse($produk->exp_date)->diffInDays(now()) <= 7)
                                <span class="expired">Segera Kedaluwarsa!</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
