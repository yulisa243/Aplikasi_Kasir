<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }
        .header-table {
            width: 100%;
            border: none;
            margin-bottom: 20px;
            text-align: center;
        }
        .header-table td {
            border: none;
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #5d87ff;
            color: white;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
<p class="text-right">{{ $profile->alamat ?? 'Alamat tidak tersedia' }}</p>
<p class="text-right"> {{ $profile->no_telp ?? '-' }}</p>
    </div>

    </br>
    <h3 align="center">Laporan Data Supplier</h3>
    </br>
    <p class="text-left">Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 40%;">Suplier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supliers as $index => $suplier)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $suplier->SuplierNama }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>