
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/Savelle.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
.card-header-custom {
    background-color: #5d87ff !important;
    color: white !important;
    padding: 10px;
    text-align: center;
    font-size: 1.2rem;
}
      
.card-header-custom h5 {
    color: white !important;  /* Pastikan tulisan h5 juga putih */
}


.form-control {
            border-radius: 0.375rem;
        }
        .btn-custom {
            background-color: #5d87ff !important;
            color: white !important;
            border-radius: 0.375rem !important;
        }
        .btn-custom:hover {
            background-color: #4b75d7 !important;
        }
        .form-group label {
            font-weight: bold;
        }
        .text-danger {
            font-size: 0.875rem;
        }

        .card-body {
    max-height: 80vh;
    overflow-y: auto;
}



        .sidebar-custom {
    background-color: #5d87ff !important; /* Warna biru */
    color: white !important; /* Warna teks putih */
    padding: 15px;
    width: 250px; /* Atur lebar sidebar */
    min-height: 100vh; /* Sesuaikan tinggi dengan layar */
}

.sidebar-custom a {
    color: white !important;
    text-decoration: none;
    display: block;
    padding: 10px;
    border-radius: 0.375rem;
}

.sidebar-custom a:hover {
    background-color: #4b75d7 !important;
}

.sidebar-custom .menu-title {
    font-size: 1.2rem;
    font-weight: bold;
    text-align: center;
    padding-bottom: 10px;
}

@media (min-width: 768px) {
    .sidebar-custom {
        width: 250px; /* Sidebar tetap lebar di layar besar */
    }
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

<!-- Menampilkan pesan sukses -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Menampilkan pesan error -->
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if ($errors->has('Stok'))
    <div class="alert alert-danger">
        {!! $errors->first('Stok') !!}
    </div>
@endif

<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-12 mb-3">
            @if(auth()->user()->role == 'admin')
                @includeIf('layout_admin.sidebar')
            @elseif(auth()->user()->role == 'user')
                @includeIf('layout_kasir.sidebar')
            @endif
        </div>

        <!-- Konten Utama -->
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header card-header-custom text-center" style="background-color: #5d87ff;">
                    <h5 class="text-white">Tambah Data Penjualan</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('penjualans.store') }}">
                        @csrf

    <div class="form-group">
    <label for="Kasir">Nama Kasir:</label>
    <input type="text" name="Kasir" id="Kasir" class="form-control" 
        value="{{ auth()->user()->name ?? '' }}" readonly>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label for="PelangganID">Pelanggan:</label>
        <select name="PelangganID" id="PelangganID" class="form-control select2">
            <option value="">-- Pilih Pelanggan --</option>
            @foreach ($pelanggans as $pelanggan)
                <option value="{{ $pelanggan->PelangganID }}">
                    {{ $pelanggan->NamaPelanggan }} - {{ $pelanggan->Notelp }}
                </option>
            @endforeach
        </select>
    </div>



</div>
<div class="form-group">
    <label for="TanggalPenjualan">Tanggal Penjualan</label>
    <input type="text" name="TanggalPenjualan" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}" readonly>
</div>





<div id="produkContainer">
    <div class="form-row mb-3 produk-entry">
        <div class="col-md-4">
            <label for="produk_id">Nama Produk</label>
            <select name="ProdukID[]" class="form-control produkSelect" required>
                <option value="">--</option>
                @foreach ($produks as $produk)
                <option value="{{ $produk->ProdukID }}" 
                    data-harga="{{ $produk->Harga }}" 
                    data-stok="{{ $produk->Stok }}">
                {{ $produk->NamaProduk }} - Stok: {{ $produk->Stok }}
            </option>
            
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>Harga</label>
            <input type="text" class="form-control hargaProduk formatRupiah">
        </div>

        <div class="col-md-4">
            <label for="JumlahProduk">Jumlah Produk</label>
            <input type="number" name="JumlahProduk[]" class="form-control jumlahProdukInput" value="1" required>
        </div>
    </div>
</div>


    <button type="button" id="addProdukBtn" class="btn btn-custom mb-3">Tambah Produk</button>

    
    <div class="form-row">
        <div class="form-group col-md-6 mb-3">
            <label for="TotalHarga">Total Harga</label>
            <input type="text" id="TotalHarga" class="form-control" readonly>
            <input type="hidden" name="TotalHargaHidden" id="TotalHargaHidden">
        </div>

        <div class="form-group col-md-6 mb-3">
            <label for="Pembayaran">Pembayaran</label>
            <input type="number" id="Pembayaran" name="Pembayaran" class="form-control" placeholder="Masukkan jumlah pembayaran" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6 mb-3">
            <label for="Kembalian">Kembalian</label>
            <input type="text" id="Kembalian" class="form-control" readonly>
        </div>
    </div>

    <div class="form-group d-flex justify-content-start">
    <a href="{{ route('penjualans.index') }}" class="btn btn-custom mr-2">Kembali</a>
    <button type="submit" class="btn btn-custom">Simpan</button>
        </div>
</form>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<script>
  $(document).ready(function() {
    // Inisialisasi Select2 untuk pelanggan
    $('#PelangganID').select2({
        placeholder: "-- Pilih Pelanggan --",
        allowClear: true,
        width: '100%'
    });

    // Inisialisasi Select2 untuk produk
       $('.produkSelect').select2({
        placeholder: "-- Pilih Produk --",
        allowClear: true,
        width: '100%'
    });

    
    // Tambah baris produk
    $('#addProdukBtn').on('click', function () {
        let clone = $('.produk-entry:first').clone();
        clone.find('select').val('').trigger('change');
        clone.find('input').not('[readonly]').val('');
        clone.find('.select2-container').remove(); // hapus Select2 sebelumnya
        clone.find('.produkSelect').show(); // munculkan select asli

        $('#produkContainer').append(clone);
        clone.find('.produkSelect').select2({
            placeholder: "-- Pilih Produk --",
            allowClear: true,
            width: '100%'
        });

        bindProdukEvents(clone); // Bind event untuk clone baru
    });

    // Tambahkan produk baru
    $('#addProdukBtn').on('click', function() {
        let newProdukEntry = $('.produk-entry:first').clone();
        
        // Reset input nilai di dalam elemen yang baru
        newProdukEntry.find('select').val("").trigger('change'); // Reset Select2
        newProdukEntry.find('input').val(""); // Reset semua input
        
        // Tambahkan produk baru ke container
        $('#produkContainer').append(newProdukEntry);

        // Inisialisasi Select2 pada elemen yang baru
        newProdukEntry.find('.produkSelect').select2({
            placeholder: "-- Pilih Produk --",
            allowClear: true,
            width: '100%'
        });
    });

    // Event untuk update harga dan stok saat produk dipilih
    $(document).on('change', '.produkSelect', function() {
        let selectedOption = $(this).find(':selected');
        let hargaProduk = parseInt(selectedOption.data('harga')) || 0;
        let stokAvailable = parseInt(selectedOption.data('stok')) || 0;

        let produkEntry = $(this).closest('.produk-entry');
        let jumlahInput = produkEntry.find('.jumlahProdukInput');

        // Perbarui harga produk
        produkEntry.find('.hargaProduk').val('Rp. ' + hargaProduk.toLocaleString());

        // Cek jumlah produk vs stok tersedia
        jumlahInput.on('input', function() {
            let jumlahProduk = parseInt(jumlahInput.val());

            // Jika jumlah lebih dari stok, tampilkan peringatan
            if (jumlahProduk > stokAvailable) {
                alert(`Stok tidak mencukupi! Stok tersedia hanya ${stokAvailable} unit.`);
                jumlahInput.val(stokAvailable); // Paksa ke stok maksimum
            }

            hitungTotalHarga();
        });

        hitungTotalHarga();
    });

    // Hitung total harga saat ada perubahan
    $(document).on('input change', '#produkContainer, #Pembayaran', function() {
        hitungTotalHarga();
    });

    // Fungsi hitung total harga
    function hitungTotalHarga() {
        let totalHarga = 0;

        $('.produk-entry').each(function() {
            let jumlahProduk = parseInt($(this).find('.jumlahProdukInput').val()) || 1;
            let produkSelect = $(this).find('.produkSelect');
            let produkHarga = parseInt(produkSelect.find(':selected').data('harga')) || 0;

            totalHarga += jumlahProduk * produkHarga;
        });

        $('#TotalHarga').val('Rp. ' + totalHarga.toLocaleString());
        $('#TotalHargaHidden').val(totalHarga);
        hitungKembalian(totalHarga);
    }

    
    // Fungsi hitung kembalian
    function hitungKembalian(totalHarga) {
        let pembayaran = parseInt($('#Pembayaran').val()) || 0;
        let kembalian = pembayaran >= totalHarga ? pembayaran - totalHarga : 0;

        $('#Kembalian').val('Rp. ' + kembalian.toLocaleString());
    }

    // Validasi saat submit form
    $('#penjualanForm').on('submit', function(e) {
        let pembayaran = $('#Pembayaran').val();
        let produkEntries = $('.produk-entry');

        if (!pembayaran || pembayaran <= 0) {
            e.preventDefault();
            alert('Pembayaran harus diisi dan lebih besar dari 0');
        }

        if (produkEntries.length === 0) {
            e.preventDefault();
            alert('Setidaknya satu produk harus dipilih.');
        }
    });

    hitungTotalHarga(); // Hitung total harga saat halaman dimuat
});

</script>

</body>
</html>
