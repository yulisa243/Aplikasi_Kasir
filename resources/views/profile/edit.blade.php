
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Toko</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .card-profile {
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #5d87ff;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .btn-custom {
            background-color: #5d87ff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #4b75d7;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card card-profile">
            <div class="card-header">Edit Profil Toko</div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center">
                        <<img src="{{ optional($profile)->logo ? asset('storage/' . $profile->logo) : asset('images/default-logo.png') }}"
                        alt="Logo Toko" class="profile-img">
                   
                    </div>
                    
                    <div class="form-group mt-3">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control" value="{{ $profile->nama_toko ?? '' }}" required>
                        </div>
                    
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ $profile->alamat ?? '' }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ $profile->no_telp ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label>Upload Logo</label>
                        <input type="file" name="logo" class="form-control-file">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah logo.</small>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>