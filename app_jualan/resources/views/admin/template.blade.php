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
    /* Custom Styles for Admin */
    .main-content {
      padding: 20px;
    }
    /* Tambahkan gaya untuk tabel agar rapi */
    .table th {
      background-color: #5d87ff;
      color: white;
      text-align: center;
    }
    .table-bordered {
      border: 1px solid #5d87ff;
    }
    .table tbody tr:hover {
      background-color: #e0eaff;
    }
    /* Button Custom Style */
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

@include('layout_admin.navbar') <!-- Include sidebar -->

<!-- sidebar start -->
@include('layout_admin.sidebar') <!-- Include sidebar -->
<!-- sidebar end -->

<div class="main-content">
  @yield('content') <!-- Main content section -->
</div>

@if(Request::is('admin') || Request::is('/'))
  @include('layout_admin.content') <!-- Include content -->
@endif

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
