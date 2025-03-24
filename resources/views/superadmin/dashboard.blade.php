@extends('layouts.app')

@section('title', 'Dashboard Superadmin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Dashboard Superadmin</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>

    <div class="row mt-4">
        <!-- Total Admins -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow-lg">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-person-badge fs-1 me-3"></i>
                    <div>
                        <h5 class="card-title">Total Admin</h5>
                        <p class="card-text fs-3">{{ $totalAdmins }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total VP -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3 shadow-lg">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-award fs-1 me-3"></i>
                    <div>
                        <h5 class="card-title">Total VP</h5>
                        <p class="card-text fs-3">{{ $totalVps }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total BPO -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3 shadow-lg">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-briefcase fs-1 me-3"></i>
                    <div>
                        <h5 class="card-title">Total BPO</h5>
                        <p class="card-text fs-3">{{ $totalBpos }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
