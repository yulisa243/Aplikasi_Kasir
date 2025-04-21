<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Savelle Store</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/Savelle.png" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url("{{ asset('assets/images/bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .banner_section {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 20px auto;
            text-align: center;
        }

        .banner_content h4 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .banner_content p {
            font-size: 1rem;
            color: #555;
        }

        .banner_section img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .banner_section {
                padding: 20px;
            }
            .banner_content h4 {
                font-size: 1.5rem;
            }
            .banner_content p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: #5d87ff; padding: 15px 0;">
    <div class="container">
        <a class="navbar-brand fw-bold text-white fs-3" style="font-family: 'Poppins', sans-serif;">Savelle Store</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold fs-5 me-3" href="{{ url('/login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold fs-5" href="{{ url('/register') }}">Registrasi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Banner Section -->
<div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 80vh; padding: 20px;">
    <h4 class="fw-bold text-dark" style="font-size: 2.5rem; font-family: 'Poppins', sans-serif;">Savelle Store – Aplikasi Kasir Modern</h4>
    <p class="text-secondary" style="font-size: 1rem; max-width: 600px; font-family: 'Poppins', sans-serif;">
        Kelola transaksi, stok, dan laporan keuangan dengan mudah dan efisien menggunakan Savelle Store.
    </p>
    <img src="{{ asset('assets/images/img-1.png') }}" alt="POS Image" class="img-fluid mt-3" style="max-width: 70%;">
</div>

<!-- JavaScript Files -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let navbarToggler = document.querySelector(".navbar-toggler");
        let navbarCollapse = document.querySelector("#navbarNav");
        
        navbarToggler.addEventListener("click", function () {
            navbarCollapse.classList.toggle("show");
        });
    });
</script>

</body>
</html>
