@extends('layouts.app')

@section('title', 'Dashboard VP')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Dashboard VP</h2>
        <p class="text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Card Pending -->
        <div class="col-md-4">
            <a href="{{ route('vp.daftar_ajuan') }}" class="text-decoration-none">
                <div class="card bg-warning text-white shadow-lg border-0 rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-hourglass-half fa-3x mb-2"></i>
                        <h5 class="fw-bold mt-2">Pengajuan Pending</h5>
                        <h2 class="fw-bold">{{ $pendingCount }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Disetujui -->
        <div class="col-md-4">
            <a href="{{ route('vp.daftar_ajuan') }}" class="text-decoration-none">
                <div class="card bg-success text-white shadow-lg border-0 rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x mb-2"></i>
                        <h5 class="fw-bold mt-2">Pengajuan Disetujui</h5>
                        <h2 class="fw-bold">{{ $approvedCount }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Ditolak -->
        <div class="col-md-4">
            <a href="{{ route('vp.daftar_ajuan') }}" class="text-decoration-none">
                <div class="card bg-danger text-white shadow-lg border-0 rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-times-circle fa-3x mb-2"></i>
                        <h5 class="fw-bold mt-2">Pengajuan Ditolak</h5>
                        <h2 class="fw-bold">{{ $rejectedCount }}</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Filter Tahun -->
    <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
            <form method="GET" action="{{ route('vp.dashboard') }}">
                <div class="input-group">
                    <label class="input-group-text" for="tahun"><i class="fas fa-calendar-alt me-2"></i>Tahun</label>
                    <select class="form-select" name="tahun" id="tahun">
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="mb-4 text-center fw-bold">Grafik Pengajuan Per Bulan ({{ $tahun }})</h5>
                <canvas id="pengajuanChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pengajuanChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Pending',
                    data: Object.values(@json($monthlyDataPending)),
                    backgroundColor: 'rgba(255, 193, 7, 0.6)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Disetujui',
                    data: Object.values(@json($monthlyDataApproved)),
                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ditolak',
                    data: Object.values(@json($monthlyDataRejected)),
                    backgroundColor: 'rgba(220, 53, 69, 0.6)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 15
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision:0
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Pengajuan'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            }
        }
    });
</script>
@endsection
