@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">
    <h3>Dashboard Admin</h3>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <style>
            .card-hover {
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                border: none;
            }
            .card-hover:hover {
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }
            .card-body {
                padding: 20px;
            }
        </style>

        <!-- Card Jumlah Pengajuan Pending -->
        <div class="col">
            <a href="{{ route('admin.pengajuan.index') }}" class="text-decoration-none">
                <div class="card text-white bg-warning shadow-sm rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-hourglass-half fa-3x mb-2"></i>
                        <h5 class="fw-bold">Pengajuan Pending</h5>
                        <h2 class="fw-bold">{{ $pendingCount }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Jumlah Pengajuan Disetujui -->
        <div class="col">
            <a href="{{ route('admin.pengajuan.index') }}" class="text-decoration-none">
                <div class="card text-white bg-success shadow-sm rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x mb-2"></i>
                        <h5 class="fw-bold">Pengajuan Disetujui</h5>
                        <h2 class="fw-bold">{{ $approvedCount }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Jumlah Pengajuan Ditolak -->
        <div class="col">
            <a href="{{ route('admin.pengajuan.index') }}" class="text-decoration-none">
                <div class="card text-white bg-danger shadow-sm rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-times-circle fa-3x mb-2"></i>
                        <h5 class="fw-bold">Pengajuan Ditolak</h5>
                        <h2 class="fw-bold">{{ $rejectedCount }}</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h4>Grafik Pengajuan Per Bulan</h4>
            <canvas id="pengajuanChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Menyuntikkan data JSON ke dalam JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mendapatkan data dari PHP ke dalam JavaScript
    var monthlyDataPending = <?php echo json_encode($monthlyDataPending); ?>;
    var monthlyDataApproved = <?php echo json_encode($monthlyDataApproved); ?>;
    var monthlyDataRejected = <?php echo json_encode($monthlyDataRejected); ?>;
    
    console.log(monthlyDataPending, monthlyDataApproved, monthlyDataRejected); // Pastikan data sudah diterima dengan benar
    
    var ctx = document.getElementById('pengajuanChart').getContext('2d');
    var pengajuanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Pending',
                    data: Object.values(monthlyDataPending),
                    backgroundColor: 'rgba(255, 193, 7, 0.5)', // Warna untuk pending
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Disetujui',
                    data: Object.values(monthlyDataApproved),
                    backgroundColor: 'rgba(40, 167, 69, 0.5)', // Warna untuk disetujui
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ditolak',
                    data: Object.values(monthlyDataRejected),
                    backgroundColor: 'rgba(220, 53, 69, 0.5)', // Warna untuk ditolak
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
