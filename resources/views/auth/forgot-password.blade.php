<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Savelle POS</title>
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
            border: 1px solid #ddd;
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

        .status-message {
            margin-top: 15px;
            font-size: 14px;
            color: green;
        }

        .error-message {
            margin-top: 15px;
            font-size: 14px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="auth-box">
        <h3>Forgot Password</h3>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Lupa kata sandi? Masukkan email Anda, dan kami akan mengirimkan tautan untuk mereset kata sandi.') }}
        </div>        
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input id="email" type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            </div>
        
            <button type="submit" class="btn-custom">Kirim tautan reset kata sandi</button>
        
            <div class="mt-3">
                <a href="{{ route('login') }}" class="toggle-link">Kembali ke halaman login</a>
            </div>
        </form>
        

        @if (session('status'))
            <div class="status-message">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
