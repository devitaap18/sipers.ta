@extends('layouts.app')

@section('title', 'Daftar Ajuan')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold">Daftar Ajuan</h2>
    <p>Berikut adalah daftar pengajuan yang telah diajukan.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-4" style="border-collapse: collapse;">
    <thead class="table-dark">
        <tr style="border-top: 2px solid black; border-bottom: 2px solid black;">
            <th>No.</th>
            <th>Perihal</th>
            <th>Tanggal Pemohon</th>
            <th>Status VP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengajuan as $index => $data)
            <tr style="border-top: 1px solid gray; border-bottom: 1px solid gray;">
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->perihal }}</td>
                <td>{{ \Carbon\Carbon::parse($data->tanggal_pemohon)->format('d-m-Y') }}</td>
                
                <!-- Kolom Status -->
                <td>
                    <span class="badge bg-{{ $data->status_vp == 'pending' ? 'warning' : ($data->status_vp == 'disetujui' ? 'success' : 'danger') }}">
                        {{ ucfirst($data->status_vp) }}
                    </span>
                </td>

                <td>
                    <!-- Tombol Lihat Deskripsi -->
                    <button class="btn btn-primary btn-sm lihat-deskripsi"
                            data-id="{{ $data->id }}"
                            data-nama="{{ $data->user->name }}"
                            data-departemen="{{ $data->departemen }}"
                            data-tanggal="{{ \Carbon\Carbon::parse($data->tanggal_pemohon)->format('d-m-Y') }}"
                            data-perihal="{{ $data->perihal }}"
                            data-deskripsi="{{ $data->deskripsi }}"
                            data-status-vp="{{ $data->status_vp }}"
                            data-catatanvp="{{ $data->deskripsi_status_vp }}">
                        <i class="fas fa-info-circle"></i> Lihat Deskripsi
                    </button>

                    <!-- Tombol Ubah Status -->
                    <button class="btn btn-warning btn-sm ubah-status-vp"
                            data-id="{{ $data->id }}"
                            data-status-vp="{{ $data->status_vp }}">
                        <i class="fas fa-edit"></i> Ubah Status
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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

<!-- Script untuk Menampilkan Data ke Modal -->
<script>
    // Tombol lihat deskripsi
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.lihat-deskripsi').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('modalNama').textContent = this.getAttribute('data-nama');
                document.getElementById('modalDepartemen').textContent = this.getAttribute('data-departemen');
                document.getElementById('modalTanggal').textContent = this.getAttribute('data-tanggal');
                document.getElementById('modalPerihal').textContent = this.getAttribute('data-perihal');
                document.getElementById('modalDeskripsi').textContent = this.getAttribute('data-deskripsi');
                
                // Set warna badge status
                let modalStatus = document.getElementById('modalStatus');
                let status_vp = this.getAttribute('data-status-vp');
                modalStatus.textContent = status_vp.charAt(0).toUpperCase() + status_vp.slice(1);
                modalStatus.className = "badge bg-" + (status_vp === "pending" ? "warning" : (status_vp === "disetujui" ? "success" : "danger"));

                // Menangani catatan VP
                let catatanVP = this.getAttribute('data-catatanvp');
                let modalCatatanVP = document.getElementById('modalCatatanvp');
                
                if (!catatanVP || catatanVP.trim() === "") {
                    modalCatatanVP.innerHTML = "<span class='text-danger'>Anda belum memberikan catatan ke pengajuan ini</span>";
                } else {
                    modalCatatanVP.textContent = catatanVP;
                }

                new bootstrap.Modal(document.getElementById('detailModal')).show();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        let selectedId = null;

        // Tombol ubah status
        document.querySelectorAll('.ubah-status-vp').forEach(button => {
            button.addEventListener('click', function () {
                selectedId = this.getAttribute('data-id');
                document.getElementById('newStatus').value = this.getAttribute('data-status-vp');
                document.getElementById('deskripsi_status_vp').value = ""; // Reset deskripsi status
                new bootstrap.Modal(document.getElementById('ubahStatusModal')).show();
            });
        });

        // Konfirmasi ubah status dengan AJAX
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
                    location.reload(); // Reload halaman setelah update status
                } else {
                    alert("Gagal mengubah status");
                }
            });
        });
    });
</script>

@endsection
