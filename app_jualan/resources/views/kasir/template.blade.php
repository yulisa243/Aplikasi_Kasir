<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/savelle.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/themify-icons/0.0.0/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Custom Styles */
    .main-content {
      display: flex; /* Menggunakan Flexbox */
      justify-content: flex-start; /* Mengatur posisi konten */
      margin-left: 250px; /* Memberikan ruang untuk sidebar */
      padding: 20px;
    }

    @media (max-width: 768px) {
  .main-content {
    flex-direction: column; /* Menumpuk konten secara vertikal pada layar kecil */
    margin-left: 0;
  }

  .sidebar {
    width: 100%;
    position: static; /* Mengubah sidebar menjadi statis di bawah navbar */
  }

  .table-container {
    margin-left: 0;
  }
}


    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th, .table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .table th {
      background-color: #5d87ff;
      color: white;
    }

    .table tbody tr:hover {
      background-color: #e0eaff;
    }
  </style>
</head>

<body>

@include('layout_kasir.navbar') <!-- Include navbar -->

<!-- sidebar start -->
@include('layout_kasir.sidebar') <!-- Include sidebar -->
<!-- sidebar end -->

<div class="main-content">
  <div class="table-container">
    @yield('content') <!-- Main content section -->
  </div>
</div>

<!-- Scripts -->
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/dashboard.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

</body>

</html>
