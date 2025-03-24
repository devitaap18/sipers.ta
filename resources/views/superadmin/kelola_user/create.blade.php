@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container">
    <h2 class="my-4">Tambah User</h2>

    <form action="{{ route('superadmin.kelola-user.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="vp">VP</option>
                <option value="bpo">BPO</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('superadmin.kelola-user.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
