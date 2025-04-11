
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">Tambah Profil Toko</div>
        <div class="card-body">
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Toko</label>
                    <input type="text" name="nama_toko" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" name="no_telp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Logo Toko (Opsional)</label>
                    <input type="file" name="logo" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('profile.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
