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
        @if (session('success'))
            <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-profile">
            <div class="card-header">Profil Toko</div>
            <div class="card-body text-center">
                <img src="{{ optional($profile)->logo ? asset('storage/' . $profile->logo) : asset('images/default-logo.png') }}" 
                     alt="Logo Toko" class="profile-img">
                <h4 class="mt-2">{{ optional($profile)->nama_toko }}</h4>
                <p class="text-muted">{{ optional($profile)->alamat }}</p>
                <p><i class="fas fa-phone"></i> {{ optional($profile)->no_telp }}</p>

                <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

                    <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
