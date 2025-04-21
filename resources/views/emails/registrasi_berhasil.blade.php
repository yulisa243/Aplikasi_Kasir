<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .box {
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            color: #007bff;
        }
        .content {
            margin-top: 20px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Halo, {{ $user->name }}!</h2>
        </div>
        <div class="box">
            <div class="content">
                <p>Terima kasih telah mendaftar di aplikasi kami.</p>
                <p>Akun Anda sedang menunggu persetujuan dari admin. Silakan tunggu konfirmasi selanjutnya melalui email jika akun Anda sudah disetujui.</p>
            </div>
        </div>
        <div class="footer">
            <p>Salam,</p>
            <p><strong>Tim Admin</strong></p>
        </div>
    </div>
</body>
</html>
