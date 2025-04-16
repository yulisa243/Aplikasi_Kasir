<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/Savelle.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <style>
        .card {
            margin-top: 30px;
        }
        .card-header {
            background-color: #5d87ff;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        .btn-custom {
            background-color: #5d87ff !important;
            color: white !important;
            border-radius: 0.375rem;
        }
        .btn-custom:hover {
            background-color: #4b75d7 !important;
        }
    </style>
</head>
<body>



<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            @if(auth()->user()->role == 'admin')
                @includeIf('layout_admin.sidebar')
            @elseif(auth()->user()->role == 'user')
                @includeIf('layout_kasir.sidebar')
            @endif
        </div>
        <div class="col-md-9">
            <div class="card">
            <div class="card-header card-header-custom text-center" style="background-color: #5d87ff;">
            <h5 class="text-white">Tambah  Data Produk</h5>
        </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('produks.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="NamaProduk" class="form-label">Nama Produk</label>
                            <input type="text" name="NamaProduk" id="NamaProduk" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Harga" class="form-label">Harga</label>
                            <input type="text" name="Harga" id="Harga" class="form-control formatAngka" required>
                        </div>
                        

                        <div class="mb-3">
                            <label for="Stok" class="form-label">Stok</label>
                            <input type="number" name="Stok" id="Stok" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="CategoryID" class="form-label">Kategori</label>
                            <select name="CategoryID" id="CategoryID" class="form-control select2" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->CategoryID }}">{{ $category->CategoryName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="SuplierID" class="form-label">Suplier</label>
                            <select name="SuplierID" id="SuplierID" class="form-control select2" required>
                                <option value="" selected disabled>-- Pilih Suplier --</option>
                                @foreach ($supliers as $suplier)
                                    <option value="{{ $suplier->SuplierID }}">{{ $suplier->SuplierNama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exp_date" class="form-label">Tanggal Kadaluarsa</label>
                            <input type="date" name="exp_date" id="exp_date" class="form-control" required>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('produks.index') }}" class="btn btn-custom">Kembali</a>
                            <button type="submit" class="btn btn-custom">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
    console.log("Select2 Loaded");
    $('#CategoryID').select2({
        placeholder: "-- Pilih Kategori --",
        allowClear: true,
        width: '100%'
    });
  });

  $(document).ready(function() {
    console.log("Select2 Loaded");
    $('#SuplierID').select2({
        placeholder: "-- Pilih Suplier --",
        allowClear: true,
        width: '100%'
    });
  });

  $(document).on('input', '.formatAngka', function () {
    let angka = $(this).val().replace(/\D/g, '');
    $(this).val(new Intl.NumberFormat('id-ID').format(angka));
});

// Saat form disubmit, bersihin titiknya
$('form').on('submit', function () {
    let angka = $('#Harga').val().replace(/\./g, '');
    $('#Harga').val(angka);
});


</script>
</body>
</html>
