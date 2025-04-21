<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Savelle POS</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: url("{{ asset('assets/images/bg.jpg') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-box h3 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .register-box .input-group {
            margin-bottom: 15px;
        }

        .register-box input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .register-box button {
            width: 100%;
            padding: 12px;
            background-color: #5d87ff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .register-box button:hover {
            background-color: #4a70e0;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h3>Registrasi</h3>
        <form action="/register" method="POST" autocomplete="off">
            @csrf
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nama" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off">
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="new-password">
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required autocomplete="new-password">
            </div>

            <!-- Tambahan input untuk Alamat -->
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-map-marker-alt"></i></span>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
            </div>

            <!-- Tambahan input untuk Nomor Telepon -->
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" required>
            </div>

            <button type="submit">Registrasi</button>
        </form>
    </div>
</body>
</html>
