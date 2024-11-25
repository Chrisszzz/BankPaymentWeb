<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #3F51B5;
            color: white;
        }

        .sidebar .logo {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar .menu a {
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 14px;
        }

        .sidebar .menu a:hover {
            background-color: #0d6efd;
            padding: 10px;
            border-radius: 5px;
        }

        .header {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header .user-info {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .header .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .header .user-info span {
            font-size: 14px;
            font-weight: bold;
        }

        .content {
            min-height: 100vh;
            /* Menyesuaikan tinggi layar penuh */
            overflow-y: auto;
            /* Menambahkan scroll jika konten terlalu panjang */
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column flex-md-row vh-100">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column flex-shrink-0 p-3"
            style="width: 250px; min-height: 100vh; overflow-y: auto;">
            <div class="logo text-center mb-4">
                <img src="https://www.freepnglogos.com/uploads/logo-bca-png/bca-online-digital-printing-company-jakarta-mediakreasi-12.png"
                    width="150" height="120" alt="Logo" class="img-fluid">
            </div>
            <div class="menu">
                <a href="/home" class="d-block py-2 text-white"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="/instansi" class="d-block py-2 text-white"><i class="bi bi-building"></i> Data Instansi</a>
                <a href="/va" class="d-block py-2 text-white"><i class="bi bi-card-list"></i> Data VA</a>
                <a href="/tambahmahasiswa" class="d-block py-2 text-white">
                    <i class="bi bi-person-plus me-2"></i> Tambah Data Mahasiswa/i
                </a>
                <a href="/reports" class="d-block py-2 text-white"><i class="bi bi-file-bar-graph"></i> Report
                    Tagihan</a>
            </div>
            <div class="footer mt-auto pt-5">
                <p class="text-white">ADMINISTRATOR</p>
                <p class="text-white">Admin01</p>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content flex-grow-1">
            <!-- Header -->
            <div class="header bg-light d-flex align-items-center justify-content-end px-4 py-2">
                <div class="user-info d-flex align-items-center">
                    <img src="https://via.placeholder.com/40" alt="User Avatar" class="rounded-circle">
                    <span class="ml-2 font-weight-bold">Admin Bank</span>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content p-5">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>
