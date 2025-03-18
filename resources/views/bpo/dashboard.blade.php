@extends('layouts.app')

@section('title', 'Dashboard BPO')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard BPO</h2>
        <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>
    </div>

    <!-- Grid Cards -->
    <div class="row">
        @foreach ($pengajuans as $pengajuan)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-success">Status VP >> Disetujui</span>
                        <small class="text-muted">{{ $pengajuan->updated_at->format('d M Y') }}</small>
                    </div>
                        <h5 class="card-title fw-bold">{{ $pengajuan->perihal }}</h5>
                        <p class="text-muted">Departemen: <strong>{{ $pengajuan->departemen }}</strong></p>
                        <a href="/bpo/pengajuan" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($pengajuans->isEmpty())
        <p class="text-center text-muted mt-4">✨ Tidak ada pengajuan yang disetujui VP saat ini.</p>
    @endif
</div>
@endsection
