@if ($expiringProducts->count() > 0)
    <div class="alert alert-warning">
        <strong>Perhatian!</strong> Ada {{ $expiringProducts->count() }} produk yang akan segera kedaluwarsa.
        <ul>
            @foreach ($expiringProducts as $produk)
                <li>{{ $produk->nama_produk }} - Exp: {{ \Carbon\Carbon::parse($produk->tanggal_exp)->format('d-m-Y') }}</li>
            @endforeach
        </ul>
    </div>
@endif
