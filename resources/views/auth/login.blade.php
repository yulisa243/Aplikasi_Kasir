<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Savelle POS</title>
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

        .auth-box {
            background: rgba(255, 255, 255, 0.95);
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

        .auth-box h3 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .form-control {
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            background-color: #5d87ff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-custom:hover {
            background-color: #4a70e0;
            transform: translateY(-2px);
        }

        .toggle-link {
            margin-top: 15px;
            display: block;
            color: #5d87ff;
            cursor: pointer;
            text-decoration: none;
        }

        .toggle-link:hover {
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>


    <div class="auth-box" id="loginBox">
        <h3>Login</h3>
    
        <!-- Menampilkan error jika login gagal -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-custom">Login</button>
            <div class="mt-3">
                <a href="{{ route('password.request') }}" class="toggle-link">Lupa Password?</a>
            </div>
        </div>
        </form>
    </div>
    

    <div class="auth-box hidden" id="registerBox">
        <h3>Registrasi</h3>
        <form action="/register" method="POST" autocomplete="off">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Nama" required>
            <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="off">
            <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="new-password">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required autocomplete="new-password">
            <button type="submit" class="btn btn-custom">Registrasi</button>
        </form>
    </div>


    
    <script>
        function toggleAuth(showId) {
            document.getElementById('loginBox').classList.add('hidden');
            document.getElementById('registerBox').classList.add('hidden');
            document.getElementById(showId).classList.remove('hidden');
        }
    </script>
</body>
</html>
