@extends('layouts.app')

@section('title', 'Dashboard VP')

@section('content')
<div class="container">
    <h2>Dashboard VP</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>

    <div class="row mt-5 justify-content-center">
        <!-- Card Jumlah Pengajuan Pending -->
        <div class="col-md-4 mb-3">
            <a href="{{ route('vp.daftar_ajuan') }}" class="text-decoration-none">
                <div class="card text-white bg-warning rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-hourglass-half fa-3x mb-3"></i>
                        <h5 class="card-title fw-bold">Pengajuan Pending</h5>
                        <h2 class="fw-bold">{{ $pendingCount }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Jumlah Pengajuan Disetujui -->
        <div class="col-md-4 mb-3">
            <a href="{{ route('vp.daftar_ajuan') }}" class="text-decoration-none">
                <div class="card text-white bg-success rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <h5 class="card-title fw-bold">Pengajuan Disetujui</h5>
                        <h2 class="fw-bold">{{ $approvedCount }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Jumlah Pengajuan Ditolak -->
        <div class="col-md-4 mb-3">
            <a href="{{ route('vp.daftar_ajuan') }}" class="text-decoration-none">
                <div class="card text-white bg-danger rounded-4 card-hover">
                    <div class="card-body text-center">
                        <i class="fas fa-times-circle fa-3x mb-3"></i>
                        <h5 class="card-title fw-bold">Pengajuan Ditolak</h5>
                        <h2 class="fw-bold">{{ $rejectedCount }}</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .card-hover {
        transition: transform 0.2s ease;
    }

    .card-hover:hover {
        transform: scale(1.03);
    }
</style>
@endsection