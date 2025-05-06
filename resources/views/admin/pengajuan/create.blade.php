@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Pengajuan</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6><i class="bi bi-exclamation-triangle-fill"></i> Terjadi kesalahan:</h6>
                    <ul class="mb-0">
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

                <div class="mb-4">
                    <label class="form-label">Pilih Aset</label>
                    @foreach ($kategoriAset as $kategori)
                        <div class="border rounded p-3 mb-3">
                            <h6 class="fw-bold">{{ $kategori->nama }}</h6>
                            @if ($kategori->aset->isNotEmpty())
                                @foreach ($kategori->aset as $aset)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input aset-checkbox" type="checkbox" name="aset_id[]" value="{{ $aset->id }}" id="aset_{{ $aset->id }}" data-id="{{ $aset->id }}">
                                        <label class="form-check-label" for="aset_{{ $aset->id }}">
                                            {{ $aset->nama }} <small class="text-muted">(Stok: {{ $aset->stok }})</small>
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

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-check me-1"></i> Kirim Pengajuan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Script untuk toggle input jumlah --}}
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
