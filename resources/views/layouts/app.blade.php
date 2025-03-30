<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Font Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* General */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        /* Header */
        .header {
            background-color: white;
            padding: 12px 20px;
            border-bottom: 2px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .brand {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Sidebar */
        .nav-link.active {
            background-color: #ddd;
            color: white;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #ddd;
            transition: width 0.3s ease-in-out;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 12px;
            color: #333;
            text-decoration: none;
            transition: background 0.3s;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover {
            background: #f1f1f1;
        }

        .sidebar .nav-link i {
            font-size: 18px;
            margin-left: 7px;
        }

        .sidebar.collapsed .nav-link {
            text-align: center;
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        /* Content */
        .content {
            flex-grow: 1;
            padding: 20px;
            transition: all 0.3s ease-in-out;
        }

        /* User Dropdown */
        .user-dropdown {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-dropdown img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /* Logo Images */
        .logo-group img {
            max-height: 40px;
            margin: 0 5px;
        }

        /* Button Styles */
        .btn-toggle {
            border: none;
            background: transparent;
            font-size: 20px;
            cursor: pointer;
            color: #333;
            transition: color 0.3s ease-in-out;
        }

        .btn-toggle:hover {
            color: #007bff;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <div class="container-fluid header">
        <div class="brand">
            <button id="toggleSidebar" class="btn-toggle">
                <i class="fa fa-bars"></i>
            </button>
            SIPERS
        </div>

        <!-- Logo -->
        <div class="d-none d-md-flex logo-group">
            <img src="https://jadibumn.id/wp-content/uploads/2024/02/Screenshot-2024-02-01-121658.png" alt="BUMN">
            <img src="https://pindad.com/uploads/images/content/full/logo_AKHLAK.jpg" alt="AKHLAK">
            <img src="https://upload.wikimedia.org/wikipedia/commons/d/da/Logo_Pupuk_Indonesia_%28Persero%29.png" alt="PUPUK INDONESIA">
            <img src="https://storage.googleapis.com/pkg-portal-bucket/images/template/logo-PG-agro-trans-small.png" alt="PETROKIMIA GRESIK">
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <div class="user-dropdown" data-bs-toggle="dropdown">
                <img src="https://cdn-icons-png.flaticon.com/512/9187/9187604.png" alt="User">
                <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'User' }}</span>
                <i class="fa fa-chevron-down"></i>
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

    <!-- Sidebar & Content -->
    <div class="d-flex">
        <div id="sidebar" class="sidebar">
            @include('partials.sidebar')
        </div>
        <div class="content w-100">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            let sidebar = document.getElementById("sidebar");
            let texts = document.querySelectorAll(".sidebar-text");

            sidebar.classList.toggle("collapsed");

            if (sidebar.classList.contains("collapsed")) {
                texts.forEach(text => text.style.display = "none");
            } else {
                setTimeout(() => {
                    texts.forEach(text => text.style.display = "inline");
                }, 300);
            }
        });
    </script>
</body>
</html>
