@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container">
    <h2 class="my-4">Edit User</h2>

    <form action="{{ route('superadmin.kelola-user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik', $user->nik) }}" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="vp" {{ $user->role == 'vp' ? 'selected' : '' }}>VP</option>
                <option value="bpo" {{ $user->role == 'bpo' ? 'selected' : '' }}>BPO</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('superadmin.kelola-user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
