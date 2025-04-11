<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Category</title>
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


    </br>
    <h3 align="center">Laporan Data Category</h3>
    </br>
    <p class="text-left">Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 50%;">Nama Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="text-align: left; max-width: 200px; word-wrap: break-word;">{{ $category->CategoryName }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
