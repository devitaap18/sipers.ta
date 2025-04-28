@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Menu</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah Menu -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMenuModal">Tambah Menu</button>

    <!-- Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order</th>
                <th>Nama Menu</th>
                <th>URL</th>
                <th>Icon</th>
                <th>Parent</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->order }}</td>
                <td>{{ $menu->menu_name }}</td>
                <td>{{ $menu->url }}</td>
                <td>{{ $menu->icon }}</td>
                <td>{{ $menu->parentMenu->menu_name ?? '-' }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMenuModal{{ $menu->id }}">Edit</button>

                    <!-- Delete Form -->
                    <form action="{{ route('superadmin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editMenuModal{{ $menu->id }}" tabindex="-1" aria-labelledby="editMenuModalLabel{{ $menu->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <form action="{{ route('superadmin.menu.update', $menu->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editMenuModalLabel{{ $menu->id }}">Edit Menu</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label>Nama Menu</label>
                        <input type="text" name="menu_name" class="form-control" value="{{ $menu->menu_name }}" required>
                      </div>
                      <div class="mb-3">
                        <label>URL</label>
                        <input type="text" name="url" class="form-control" value="{{ $menu->url }}">
                      </div>
                      <div class="mb-3">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $menu->order }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" name="icon" class="form-control" value="{{ $menu->icon }}">
                      </div>
                      <div class="mb-3">
                        <label>Parent Menu</label>
                        <select name="parent_id" class="form-control">
                          <option value="">- Tidak Ada -</option>
                          @foreach($parentMenus as $parent)
                            <option value="{{ $parent->id }}" {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->menu_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('superadmin.menu.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMenuModalLabel">Tambah Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="menu_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>URL</label>
            <input type="text" name="url" class="form-control">
          </div>
          <div class="mb-3">
            <label>Order</label>
            <input type="number" name="order" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Icon</label>
            <input type="text" name="icon" class="form-control">
          </div>
          <div class="mb-3">
            <label>Parent Menu</label>
            <select name="parent_id" class="form-control">
              <option value="">- Tidak Ada -</option>
              @foreach($parentMenus as $parent)
                <option value="{{ $parent->id }}">{{ $parent->menu_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
