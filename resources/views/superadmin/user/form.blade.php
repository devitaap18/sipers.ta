<div class="mb-3">
    <label for="name" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? old('name') }}" required>
</div>

<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username ?? old('username') }}" required>
</div>

<div class="mb-3">
    <label for="nik" class="form-label">NIK</label>
    <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik ?? old('nik') }}">
</div>

<div class="mb-3">
    <label for="company" class="form-label">Company</label>
    <input type="text" class="form-control" id="company" name="company" value="{{ $user->company ?? old('company') }}">
</div>

<div class="mb-3">
    <label for="role_id" class="form-label">Role</label>
    <select class="form-select" id="role_id" name="role_id" required>
        <option value="">-- Pilih Role --</option>
        @foreach($roles as $role)
        <option value="{{ $role->id }}" {{ (isset($user) && $user->role_id == $role->id) ? 'selected' : '' }}>
            {{ $role->role_name }}
        </option>
        @endforeach
    </select>
</div>
