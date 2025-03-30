@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Pengajuan</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengajuan.store') }}" method="POST" id="pengajuanForm">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Nama Pengaju</label>
            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="departemen" class="form-label">Nama Departemen</label>
                <input type="text" name="departemen" id="departemen" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal_pemohon" class="form-label">Tanggal Pemohon</label>
                <input type="date" name="tanggal_pemohon" id="tanggal_pemohon" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="perihal" class="form-label">Perihal</label>
            <input type="text" name="perihal" id="perihal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Aset</label>
            @foreach ($kategoriAset as $kategori)
                <div class="border p-3 rounded mb-2">
                    <h5>{{ $kategori->nama }}</h5>
                    @if ($kategori->aset->isNotEmpty())
                        @foreach ($kategori->aset as $aset)
                            <div class="form-check">
                                <input class="form-check-input aset-checkbox" type="checkbox" name="aset_id[]" value="{{ $aset->id }}" id="aset_{{ $aset->id }}" data-id="{{ $aset->id }}">
                                <label class="form-check-label" for="aset_{{ $aset->id }}">
                                    {{ $aset->nama }} (Stok: {{ $aset->stok }})
                                </label>
                                <input type="number" name="jumlah[{{ $aset->id }}]" class="form-control mt-1 jumlah-input" id="jumlah_{{ $aset->id }}" placeholder="Jumlah" min="1" max="{{ $aset->stok }}" style="display: none;" disabled>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Tidak ada aset dalam kategori ini.</p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
            <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function toggleInput(asetId) {
            var checkbox = document.getElementById("aset_" + asetId);
            var jumlahInput = document.getElementById("jumlah_" + asetId);
            
            if (checkbox.checked) {
                jumlahInput.style.display = "block";
                jumlahInput.removeAttribute("disabled");
            } else {
                jumlahInput.style.display = "none";
                jumlahInput.setAttribute("disabled", "true");
            }
        }

        document.querySelectorAll('.aset-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                toggleInput(this.getAttribute('data-id'));
            });
        });

        document.getElementById('pengajuanForm').addEventListener('submit', function () {
            document.querySelectorAll('.jumlah-input[disabled]').forEach(input => {
                input.removeAttribute('name');
            });
        });
    });
</script>
@endsection
