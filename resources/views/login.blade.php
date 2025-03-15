<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIMASTI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .image-section {
            background: url('https://storage.googleapis.com/pkg-portal-bucket/images/news/2022-10/ubah-limbah-jadi-bahan-baku-npk-petrokimia-gresik-hemat-rp-7-4-m/Pabrik-PG.jpeg') center/cover;
        }
    </style>
</head>
<body>
    <div class="container-fluid auth-container">
        <div class="row w-75 shadow-lg rounded">
            <!-- Grid Kiri (Gambar) -->
            <div class="col-md-6 image-section d-none d-md-block"></div>
            
            <!-- Grid Kanan (Form Login) -->
            <div class="col-md-6 p-5 bg-white">
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
