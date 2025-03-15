@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daftar Pengajuan yang Disetujui</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($pengajuan->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>Belum ada pengajuan yang disetujui oleh VP</strong>
        </div>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Pengaju</th>
                    <th>Departemen</th>
                    <th>Tanggal Pemohon</th>
                    <th>Perihal</th>
                    <th>Status BPO</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->departemen }}</td>
                    <td>{{ $p->tanggal_pemohon }}</td>
                    <td>{{ $p->perihal }}</td>
                    <td>
                        <span class="badge 
                            @if($p->status_bpo == 'belum diproses') bg-secondary
                            @elseif($p->status_bpo == 'sedang diproses') bg-warning
                            @else bg-success @endif">
                            {{ ucfirst($p->status_bpo) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('bpo.pengajuan.update-status', $p->id) }}" method="POST">
                            @csrf
                            <select name="status_bpo" class="form-select form-select-sm d-inline w-auto">
                                <option value="belum diproses" {{ $p->status_bpo == 'belum diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                <option value="sedang diproses" {{ $p->status_bpo == 'sedang diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                <option value="selesai" {{ $p->status_bpo == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
