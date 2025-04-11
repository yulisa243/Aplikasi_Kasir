<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Struk Penjualan</title>
        <style>
      
      body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f8f8;
            }

            @media print {
                @page {
                    size: 80mm 297mm;
                    margin: 0;
                }

                body {
                    margin: 0;
                    padding: 0;
                    font-size: 0.9em;
                }

                .container {
                    width: 100%;
                    padding: 10px;
                    box-sizing: border-box;
                    background-color: white;
                }

                .btn-print {
                    display: none !important;
                }

                .header img {
                    width: 80px;
                    height: auto;
                    margin-bottom: 10px;
                }

                .footer p {
                    font-size: 0.8em;
                }

                .line {
                    border-top: 1px dashed #ddd;
                    margin: 10px 0;
                }
            }

            .container {
                width: 100%;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ddd;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                font-size: 0.9em;
                max-width: 350px;
                box-sizing: border-box;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .header p {
                font-weight: bold;
                font-size: 1.5em;
                margin: 0;
                color: #333;
            }

            .header small {
                font-size: 1.1em;
                color: #777;
            }

            .content {
                margin-top: 15px;
                line-height: 1.6;
            }

            .content div {
                margin-bottom: 15px;
                display: flex;
                justify-content: space-between;
                font-size: 1em;
            }

            .content .label {
                font-weight: bold;
                color: #444;
                width: 50%;
            }

            .content .value {
                color: #333;
                text-align: right;
                width: 50%;
            }

            .line {
                border-top: 1px dashed #ddd;
                margin: 15px 0;
            }

            .total {
                font-size: 1.1em;
                font-weight: bold;
                margin-top: 20px;
                text-align: center;
                color: #000;
            }

            .footer {
                margin-top: 25px;
                text-align: center;
                font-size: 0.9em;
                color: #888;
            }

            .footer p {
                margin: 5px 0;
            }

            .btn-print {
                display: block;
                width: 100%;
                padding: 12px;
                margin-top: 20px;
                background-color: #28a745;
                color: white;
                font-size: 1em;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-align: center;
                box-sizing: border-box;
                max-width: 80mm;
                margin-left: auto;
                margin-right: auto;
                text-decoration: none;
            }

            .btn-print:hover {
                background-color: #218838;
            }

            .btn-back {
                display: block;
                width: 100%;
                padding: 12px;
                margin-top: 10px;
                background-color: #dc3545;
                color: white;
                font-size: 1em;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-align: center;
                box-sizing: border-box;
                max-width: 80mm;
                margin-left: auto;
                margin-right: auto;
                text-decoration: none;
            }

            .btn-back:hover {
                background-color: #c82333;
            }

            .content ul {
                padding-left: 0;
                list-style-type: none;
                margin: 0;
            }

            .content li {
                margin-bottom: 10px;
                display: flex;
                justify-content: space-between;
            }

            .content li span {
                font-size: 0.9em;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-control {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }
        </style>
       
    </head>
    <body>

    
    <div class="container">
    <div class="header">
            <p><strong>{{ $profile->nama_toko ?? 'Nama Toko Tidak Tersedia' }}</strong></p>
    <p class="alamat">{{ $profile->alamat ?? 'Alamat tidak tersedia' }}</p>
    <p class="alamat">Telp: {{ $profile->no_telp ?? '-' }}</p>
</div>

    </br>
        <div class="content">

        <div>
                <span class="label">ID Transaksi</span>
                <span class="value">{{ $penjualan->PenjualanID }}</span>
            </div>
            
            <div>
                <span class="label">Nama Kasir:</span>
                <span class="value">{{ $penjualan->Kasir }}</span>
            </div>

            <div>
                <span class="label">Pelanggan:</span>
                <span class="value">
                    {{ $penjualan->pelanggan ? $penjualan->pelanggan->NamaPelanggan : 'Pelanggan Tidak Ditemukan' }}
                </span>
            </div>

            <div>
                <span class="label">Tanggal:</span>
                <span class="value">{{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->format('d-m-Y') }}</span>
            </div>

                    <div class="line"></div>

            <div>
                <span class="label">Produk:</span>
                <ul>
                @foreach ($penjualan->details as $detail)
    <li>
        @if ($detail->produk)
            <span>{{ $detail->produk->NamaProduk }} - {{ $detail->JumlahProduk }} x Rp. {{ number_format($detail->produk->Harga, 0, ',', '.') }}</span>
            <span>
                @if($detail->Subtotal > 0)
                    Rp. {{ number_format($detail->Subtotal, 0, ',', '.') }}
                @endif
            </span>
        @else
            <span>Produk Tidak Ditemukan</span>
        @endif
    </li>
@endforeach

                </ul>
            </div>

            <div class="line"></div>

            <div>
                <span class="label">Jumlah Produk:</span>
                <span class="value">
                    @php
                        $totalProduk = 0;
                        foreach ($penjualan->details as $detail) {
                            $totalProduk += $detail->JumlahProduk;
                        }
                    @endphp
                    {{ $totalProduk }} Produk
                </span>
            </div>

            <div>
                <span class="label">Total Harga:</span>
                <span class="value">Rp. {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</span>
            </div>

            <div>
                <span class="label">Pembayaran:</span>
                <span class="value">Rp. {{ number_format($penjualan->Pembayaran, 0, ',', '.') }}</span>
            </div>

            <div>
                <span class="label">Kembalian:</span>
                <span class="value">Rp. {{ number_format($penjualan->Kembalian, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih atas kunjungan Anda!</p>
            <p>www.savelle.com</p>
        </div>

    </div>

    </body>
    </html>