<div class="container mt-4">
    @if(Auth::user()->role === 'admin' && isset($produks) && $produks->where('Stok', '<=', 6)->count() > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>⚠️ Perhatian!</strong> Ada {{ $produks->where('Stok', '<=', 6)->count() }} produk yang stoknya hampir habis:
            <ul class="mb-0">
                @foreach ($produks->where('Stok', '<=', 6) as $item)
                <li>
                    <i class="fas fa-exclamation-circle text-danger"></i> 
                    <strong>{{ $item->NamaProduk }}</strong> - 
                    Stok: <span class="badge bg-danger">{{ $item->Stok }}</span> | 
                    Exp: <span class="badge bg-danger">{{ \Carbon\Carbon::parse($item->tanggal_exp)->format('d-m-Y') }}</span>
                </li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="mb-3">Daftar Produk</h2>

    <table class="table table-bordered table-hover">
        <thead style="background-color: #5d87ff; color: white;">
            <tr class="text-center">
                <th>No</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Tanggal Kedaluwarsa</th>
             </tr>
        </thead>
        <tbody>
        @if(isset($produks) && $produks->isNotEmpty())
            @php $filteredProduks = $produks->filter(function ($item) {
                $expDate = \Carbon\Carbon::parse($item->tanggal_exp);
                $daysLeft = $expDate->diffInDays(\Carbon\Carbon::now(), false);
                return $item->Stok <= 6 || $daysLeft <= 7; // Hanya tampilkan yang stok ≤ 6 atau exp ≤ 7 hari
            }); @endphp

            @if($filteredProduks->isNotEmpty())
                @foreach ($filteredProduks as $index => $item)
                    @php
                        $expDate = \Carbon\Carbon::parse($item->tanggal_exp);
                        $daysLeft = $expDate->diffInDays(\Carbon\Carbon::now(), false);
                        $rowClass = ($item->Stok <= 6 || $daysLeft <= 7) ? 'table-danger' : '';
                    @endphp
                    <tr class="{{ $rowClass }}">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->NamaProduk }}</td>
                        <td class="text-center {{ $item->Stok <= 6 ? 'text-danger fw-bold' : '' }}">{{ number_format($item->Stok) }}</td>
                        <td class="text-center">
                            <span class="badge {{ $daysLeft <= 7 ? 'bg-danger' : 'bg-success' }}">
                                {{ $expDate->format('d-m-Y') }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada produk dengan stok rendah atau mendekati kedaluwarsa</td>
                </tr>
            @endif
        @else
            <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada produk yang tersedia</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
