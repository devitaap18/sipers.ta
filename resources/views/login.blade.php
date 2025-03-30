<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIMASTI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }
        .auth-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-box {
            max-width: 900px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .image-section {
            background: url('https://storage.googleapis.com/pkg-portal-bucket/images/news/2022-10/ubah-limbah-jadi-bahan-baku-npk-petrokimia-gresik-hemat-rp-7-4-m/Pabrik-PG.jpeg') center/cover;
            min-height: 300px;
        }
        @media (max-width: 768px) {
            .image-section {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container auth-container">
        <div class="row auth-box bg-white">
            <!-- Gambar (Desktop) -->
            <div class="col-md-6 image-section d-none d-md-block"></div>
            
            <!-- Form Login -->
            <div class="col-md-6 p-4">
                <h3 class="text-center mb-4">Login SIPERS</h3>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK (Nomor Induk Kerja)</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required>
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(session()->has('loginError'))
                        <div class="alert alert-danger text-center">
                            {{ session('loginError') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
