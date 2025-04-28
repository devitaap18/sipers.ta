@extends('layouts.app')

@push('styles')
<style>
    /* Tambahan sedikit polish */
    .modal-content {
        border-radius: 0.75rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    @media (max-width: 576px) {
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .modal-dialog {
            margin: 1rem;
        }

        .table th, .table td {
            white-space: nowrap;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h4 class="mb-3 mb-md-0 text-center text-md-start">Kelola Kategori Aset & Aset</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- TABLE KATEGORI --}}
    <div class="mb-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-3 gap-2">
            <h4 class="mb-2 mb-sm-0">Kategori Aset</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal" onclick="resetKategoriForm()">+ Tambah Kategori</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $k)
                        <tr>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->kode }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <button class="btn btn-warning btn-sm editKategoriBtn"
                                        data-id="{{ $k->id }}"
                                        data-nama="{{ $k->nama }}"
                                        data-kode="{{ $k->kode }}"
                                        data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                                        Edit
                                    </button>
                                    <form action="{{ route('bpo.kelola_kategori.destroy', $k->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kategori?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TABLE ASET --}}
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-3 gap-2">
            <h4 class="mb-2 mb-sm-0">Aset</h4>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahAsetModal" onclick="resetAsetForm()">+ Tambah Aset</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Kode Aset</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asets as $a)
                        <tr>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->kode_aset }}</td>
                            <td>{{ $a->kategori->nama }}</td>
                            <td>{{ $a->stok }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <button class="btn btn-warning btn-sm editAsetBtn"
                                        data-id="{{ $a->id }}"
                                        data-nama="{{ $a->nama }}"
                                        data-kode_aset="{{ $a->kode_aset }}"
                                        data-kategori_id="{{ $a->kategori_id }}"
                                        data-stok="{{ $a->stok }}"
                                        data-bs-toggle="modal" data-bs-target="#tambahAsetModal">
                                        Edit
                                    </button>
                                    <form action="{{ route('bpo.kelola_aset.destroy', $a->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus aset?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL KATEGORI --}}
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formKategori" method="POST" action="{{ route('bpo.kelola_kategori.store') }}">
            @csrf
            <input type="hidden" name="id" id="kategori_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah/Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Kategori</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL ASET --}}
<div class="modal fade" id="tambahAsetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAset" method="POST" action="{{ route('bpo.kelola_aset.store') }}">
            @csrf
            <input type="hidden" name="id" id="aset_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah/Edit Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Aset</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Aset</label>
                        <input type="text" name="kode_aset" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- JS UNTUK HANDLE EDIT --}}
<script>
    function resetKategoriForm() {
        const form = document.getElementById('formKategori');
        form.reset();
        form.action = "{{ route('bpo.kelola_kategori.store') }}";
        document.getElementById('kategori_id').value = '';
    }

    function resetAsetForm() {
        const form = document.getElementById('formAset');
        form.reset();
        form.action = "{{ route('bpo.kelola_aset.store') }}";
        document.getElementById('aset_id').value = '';
    }

    document.querySelectorAll('.editKategoriBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const kode = this.dataset.kode;
            const form = document.getElementById('formKategori');
            form.action = `/bpo/kelola_kategori/update/${id}`;
            document.getElementById('kategori_id').value = id;
            form.querySelector('input[name=nama]').value = nama;
            form.querySelector('input[name=kode]').value = kode;
        });
    });

    document.querySelectorAll('.editAsetBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const kode_aset = this.dataset.kode_aset;
            const kategori_id = this.dataset.kategori_id;
            const stok = this.dataset.stok;
            const form = document.getElementById('formAset');
            form.action = `/bpo/kelola_aset/update/${id}`;
            document.getElementById('aset_id').value = id;
            form.querySelector('input[name=nama]').value = nama;
            form.querySelector('input[name=kode_aset]').value = kode_aset;
            form.querySelector('select[name=kategori_id]').value = kategori_id;
            form.querySelector('input[name=stok]').value = stok;
        });
    });
</script>
@endsection
