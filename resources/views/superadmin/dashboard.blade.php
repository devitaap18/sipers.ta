@extends('layouts.app')

@section('title', 'Dashboard BPO')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-5">Dashboard BPO</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>

    <!-- Card Status VP Disetujui -->
    <div class="flex justify-center mt-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md w-64 text-center">
            <h3 class="text-lg font-semibold">Pengajuan Disetujui VP</h3>
            <p class="text-4xl font-bold mt-2">{{ $totalDisetujui }}</p>
        </div>
    </div>
</div>
@endsection
