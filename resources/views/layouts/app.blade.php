<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        /* Header */
        .header {
            background-color: white;
            padding: 15px 0;
            border-bottom: 2px solid #ddd;
        }
        .header .brand {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .header img {
            max-height: 50px;
        }
        /* User Dropdown */
        .user-dropdown {
            cursor: pointer;
        }
        .user-dropdown img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        /* Sidebar */
        .sidebar {
            width: 250px;
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }
        .content {
            margin-left: 250px;
            transition: margin-left 0.3s;
        }
        .content.expanded {
            margin-left: 0;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <div class="container-fluid header">
        <div class="d-flex justify-content-between align-items-center">
            
            <!-- Kiri: Logo SIPERS & Toggle Sidebar -->
            <div class="brand ms-3">
                <button id="toggleSidebar" class="btn btn-light">
                    <i class="fa fa-bars"></i>
                </button>
                SIPERS
            </div>

            <!-- Tengah: 4 Gambar -->
            <div class="d-flex gap-3">
                <img src="https://jadibumn.id/wp-content/uploads/2024/02/Screenshot-2024-02-01-121658.png" alt="BUMN">
                <img src="https://pindad.com/uploads/images/content/full/logo_AKHLAK.jpg" alt="AKHLAK">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/da/Logo_Pupuk_Indonesia_%28Persero%29.png" alt="PUPUK INDONESIA">
                <img src="https://storage.googleapis.com/pkg-portal-bucket/images/template/logo-PG-agro-trans-small.png" alt="PETROKIMIA GRESIK">
            </div>

            <!-- Kanan: User Dropdown -->
            <div class="dropdown me-3">
                <div class="user-dropdown d-flex align-items-center" data-bs-toggle="dropdown">
                    <img src="https://cdn-icons-png.flaticon.com/512/9187/9187604.png" alt="User">
                    <span class="ms-2">{{ Auth::user()->name ?? 'User' }}</span>
                    <i class="fa fa-chevron-down ms-1"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="d-flex">
        @include('partials.sidebar')

        <div class="content p-4 w-100">
            <button id="toggleSidebar" class="btn btn-primary d-md-none">
                <i class="fa fa-bars"></i>
            </button>
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.querySelector(".content").classList.toggle("expanded");
        });
    </script>
</body>
</html>
