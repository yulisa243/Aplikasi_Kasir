<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        .card-header-custom {
            background-color: #5d87ff;
            color: white;
        }
        .form-control {
            border-radius: 0.375rem;
        }
        .btn-custom {
            background-color: #5d87ff;
            color: white;
            border-radius: 0.375rem;
        }
        .btn-custom:hover {
            background-color: #4b75d7;
        }
    </style>
</head>
<body>

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header card-header-custom text-center">
                <h5>Tambah Detail Penjualan</h5>
            </div>

            <div class="card-body">
                    <form method="POST" action="{{ route('details.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="ProdukID">Nama Produk</label>
                            <select name="ProdukID" id="ProdukID" class="form-control" required>
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->ProdukID }}" {{ old('ProdukID') == $produk->ProdukID ? 'selected' : '' }}>
                                        {{ $produk->NamaProduk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ProdukID')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="JumlahProduk">Jumlah Produk</label>
                            <input type="number" name="JumlahProduk" id="JumlahProduk" class="form-control" value="{{ old('JumlahProduk') }}" required>
                            @error('JumlahProduk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                     
                        <div class="form-group">
                            <label for="ProdukID">Harga</label>
                            <select name="ProdukID" id="ProdukID" class="form-control" required>
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->ProdukID }}" {{ old('ProdukID') == $produk->ProdukID ? 'selected' : '' }}>
                                        {{ $produk->Harga }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ProdukID')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="PenjualanID">Tanggal Penjualan</label>
                            <select name="PenjualanID" id="PenjualanID" class="form-control" required>
                                @foreach ($penjualans as $penjualan)
                                    <option value="{{ $penjualan->PenjualanID }}" {{ old('PenjualanID') == $penjualan->PenjualanID ? 'selected' : '' }}>
                                        {{ $penjualan->TanggalPenjualan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('PenjualanID')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pembayaran -->
<div class="form-group mb-3">
    <label for="Pembayaran">Pembayaran</label>
    <input type="number" name="Pembayaran" id="Pembayaran" class="form-control" step="0.01" placeholder="Masukkan jumlah uang yang diterima">
</div>

<!-- Kembalian -->
<div class="form-group mb-3">
    <label for="Kembalian">Kembalian</label>
    <input type="number" name="Kembalian" id="Kembalian" class="form-control" step="0.01" readonly>
</div>


                        <a href="{{ route('details.index') }}" class="btn btn-custom">Kembali</a>
                        <button type="submit" class="btn btn-custom">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    document.getElementById('Pembayaran').addEventListener('input', function() {
        var totalHarga = parseFloat(document.getElementById('TotalHarga').value) || 0;
        var pembayaran = parseFloat(this.value) || 0;
        var kembalian = pembayaran - totalHarga;

        document.getElementById('Kembalian').value = kembalian > 0 ? kembalian : 0;
    });
</script>

