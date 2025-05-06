@extends('layouts.app')

@section('title', 'Daftar Ajuan')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body">
            <h2 class="fw-semibold mb-2"><i class="fas fa-list-alt me-2"></i>Daftar Ajuan</h2>
            <p class="text-muted">Berikut adalah daftar pengajuan yang telah diajukan oleh pemohon.</p>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Status -->
            <form method="GET" action="{{ route('vp.daftar_ajuan') }}" class="row g-3 align-items-center mb-4">
                <div class="col-auto">
                    <label for="status_vp" class="col-form-label">Filter Status</label>
                </div>
                <div class="col-md-4">
                    <select name="status_vp" id="status_vp" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status_vp') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="disetujui" {{ request('status_vp') == 'disetujui' ? 'selected' : '' }}>✅ Disetujui</option>
                        <option value="ditolak" {{ request('status_vp') == 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No.</th>
                            <th>Perihal</th>
                            <th>Tanggal Pemohon</th>
                            <th>Status VP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuan as $index => $data)
                            <tr class="text-center">
                                <td>{{ $pengajuan->firstItem() + $index }}</td>
                                <td class="text-start">{{ $data->perihal }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_pemohon)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $data->status_vp == 'pending' ? 'warning text-dark' : ($data->status_vp == 'disetujui' ? 'success' : 'danger') }}">
                                        {{ ucfirst($data->status_vp) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-outline-primary btn-sm lihat-deskripsi"
                                                data-id="{{ $data->id }}"
                                                data-nama="{{ $data->user->name }}"
                                                data-departemen="{{ $data->departemen }}"
                                                data-tanggal="{{ \Carbon\Carbon::parse($data->tanggal_pemohon)->format('d-m-Y') }}"
                                                data-perihal="{{ $data->perihal }}"
                                                data-deskripsi="{{ $data->deskripsi }}"
                                                data-status-vp="{{ $data->status_vp }}"
                                                data-catatanvp="{{ $data->deskripsi_status_vp }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm ubah-status-vp"
                                                data-id="{{ $data->id }}"
                                                data-status-vp="{{ $data->status_vp }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada pengajuan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination dan info -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <small class="text-muted">Menampilkan {{ $pengajuan->firstItem() }} - {{ $pengajuan->lastItem() }} dari {{ $pengajuan->total() }} data</small>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    {{ $pengajuan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pengajuan -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-file-alt"></i> Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>Nama Pengaju</th>
                        <td id="modalNama"></td>
                    </tr>
                    <tr>
                        <th>Departemen</th>
                        <td id="modalDepartemen"></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pemohon</th>
                        <td id="modalTanggal"></td>
                    </tr>
                    <tr>
                        <th>Perihal</th>
                        <td id="modalPerihal"></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td id="modalDeskripsi"></td>
                    </tr>
                    <tr>
                        <th>Status VP</th>
                        <td>
                            <span id="modalStatus" class="badge"></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan VP</th>
                        <td>
                            <span id="modalCatatanvp" class="fw-bold"></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Ubah Status -->
<div class="modal fade" id="ubahStatusModal" tabindex="-1" aria-labelledby="ubahStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Ubah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengubah status pengajuan ini?</p>
                <label for="newStatus" class="form-label">Pilih Status:</label>
                <select class="form-select" id="newStatus">
                    <option value="pending">Pending</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>

                <!-- Input deskripsi status -->
                <label for="deskripsi_status_vp" class="form-label mt-3">Deskripsi Status:</label>
                <textarea class="form-control" id="deskripsi_status_vp" rows="3" placeholder="Tambahkan deskripsi perubahan status..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-warning" id="confirmUbahStatus">
                    <i class="fas fa-check"></i> Ubah Status
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f1f3f5;
    }
</style>

<!-- Script untuk Menampilkan Data ke Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.lihat-deskripsi').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('modalNama').textContent = this.getAttribute('data-nama');
                document.getElementById('modalDepartemen').textContent = this.getAttribute('data-departemen');
                document.getElementById('modalTanggal').textContent = this.getAttribute('data-tanggal');
                document.getElementById('modalPerihal').textContent = this.getAttribute('data-perihal');
                document.getElementById('modalDeskripsi').textContent = this.getAttribute('data-deskripsi');
                
                let modalStatus = document.getElementById('modalStatus');
                let status_vp = this.getAttribute('data-status-vp');
                modalStatus.textContent = status_vp.charAt(0).toUpperCase() + status_vp.slice(1);
                modalStatus.className = "badge bg-" + (status_vp === "pending" ? "warning" : (status_vp === "disetujui" ? "success" : "danger"));

                let catatanVP = this.getAttribute('data-catatanvp');
                document.getElementById('modalCatatanvp').textContent = catatanVP ? catatanVP : "Tidak ada catatan";
                new bootstrap.Modal(document.getElementById('detailModal')).show();
            });
        });

        let selectedId = null;
        document.querySelectorAll('.ubah-status-vp').forEach(button => {
            button.addEventListener('click', function () {
                selectedId = this.getAttribute('data-id');
                document.getElementById('newStatus').value = this.getAttribute('data-status-vp');
                document.getElementById('deskripsi_status_vp').value = "";
                new bootstrap.Modal(document.getElementById('ubahStatusModal')).show();
            });
        });

        document.getElementById('confirmUbahStatus').addEventListener('click', function () {
            let newStatus = document.getElementById('newStatus').value;
            let deskripsi_status_vp = document.getElementById('deskripsi_status_vp').value;
            
            fetch(`/vp/daftar_ajuan/${selectedId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status_vp: newStatus, deskripsi_status_vp: deskripsi_status_vp })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Gagal mengubah status");
                }
            });
        });
    });
</script>

@endsection
