@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📋 Daftar Pengajuan Aset</h3>
        <a href="{{ route('admin.pengajuan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Buat Pengajuan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-3 g-2">
        <div class="col-md-3">
            <select id="filter_status_vp" class="form-select shadow-sm">
                <option value="">🔍 Semua Status VP</option>
                <option value="pending">⏳ Pending</option>
                <option value="disetujui">✅ Disetujui</option>
                <option value="ditolak">❌ Ditolak</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" id="search_perihal" class="form-control shadow-sm" placeholder="🔎 Cari perihal...">
        </div>
    </div>

    @if ($pengajuan->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Belum ada pengajuan aset yang tercatat.</strong>
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-hover align-middle text-center" id="pengajuan_table">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengaju</th>
                        <th>Departemen</th>
                        <th>Tanggal Pemohon</th>
                        <th>Perihal</th>
                        <th>Deskripsi</th>
                        <th>Status VP</th>
                        <th>Catatan VP</th>
                        <th>Status BPO</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $index => $p)
                    <tr>
                        <td>{{ $pengajuan->firstItem() + $index }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->departemen }}</td>
                        <td>{{ $p->tanggal_pemohon }}</td>
                        <td class="perihal">{{ $p->perihal }}</td>
                        <td>{{ Str::limit($p->deskripsi, 50) }}</td>
                        <td>
                            <span class="status_vp badge bg-{{ $p->status_vp == 'disetujui' ? 'success' : ($p->status_vp == 'pending' ? 'warning text-dark' : 'danger') }}">
                                {{ ucfirst($p->status_vp) }}
                            </span>
                        </td>
                        <td>{{ $p->deskripsi_status_vp ?: 'VP belum memberikan catatan' }}</td>
                        <td>
                            <span class="badge bg-{{ $p->status_bpo == 'selesai' ? 'success' : ($p->status_bpo == 'sedang diproses' ? 'warning text-dark' : 'secondary') }}">
                                {{ ucfirst($p->status_bpo) }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm lihat-deskripsi" data-id="{{ $p->id }}" data-bs-toggle="modal" data-bs-target="#modalDetail">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <small class="text-muted">
                    Menampilkan {{ $pengajuan->firstItem() }} - {{ $pengajuan->lastItem() }} dari {{ $pengajuan->total() }} pengajuan
                </small>
            </div>
            <div>
                {{ $pengajuan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-info-circle me-2"></i>Detail Pengajuan Aset</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Nama Pengaju</th><td id="nama_pengaju"></td></tr>
                        <tr><th>Departemen</th><td id="departemen"></td></tr>
                        <tr><th>Tanggal Pemohon</th><td id="tanggal_pemohon"></td></tr>
                        <tr><th>Perihal</th><td id="perihal"></td></tr>
                        <tr><th>Deskripsi</th><td id="deskripsi"></td></tr>
                        <tr><th>Status VP</th><td><span id="status_vp" class="badge"></span></td></tr>
                        <tr><th>Catatan VP</th><td id="deskripsi_status_vp"></td></tr>
                        <tr><th>Status BPO</th><td><span id="status_bpo" class="badge"></span></td></tr>
                        <tr><th>File PDF</th><td id="file_pdf"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    $('#filter_status_vp').change(function () {
        let filter = $(this).val().toLowerCase();
        $('#pengajuan_table tbody tr').each(function () {
            const text = $(this).find('.status_vp').text().toLowerCase();
            $(this).toggle(text.indexOf(filter) > -1 || filter === "");
        });
    });

    $('#search_perihal').on("keyup", function () {
        let value = $(this).val().toLowerCase();
        $('#pengajuan_table tbody tr').each(function () {
            const text = $(this).find('.perihal').text().toLowerCase();
            $(this).toggle(text.indexOf(value) > -1);
        });
    });

    $('.lihat-deskripsi').click(function () {
        const id = $(this).data('id');
        $.get('/admin/pengajuan/' + id, function (data) {
            const pengajuan = data.pengajuan;
            $('#nama_pengaju').text(pengajuan.user.name);
            $('#departemen').text(pengajuan.departemen);
            $('#tanggal_pemohon').text(pengajuan.tanggal_pemohon);
            $('#perihal').text(pengajuan.perihal);
            $('#deskripsi').text(pengajuan.deskripsi);
            $('#deskripsi_status_vp').text(pengajuan.deskripsi_status_vp || 'VP belum memberikan catatan');
            $('#status_vp').removeClass().addClass('badge bg-' + (pengajuan.status_vp === 'disetujui' ? 'success' : pengajuan.status_vp === 'pending' ? 'warning text-dark' : 'danger')).text(pengajuan.status_vp);
            $('#status_bpo').removeClass().addClass('badge bg-' + (pengajuan.status_bpo === 'selesai' ? 'success' : pengajuan.status_bpo === 'sedang diproses' ? 'warning text-dark' : 'secondary')).text(pengajuan.status_bpo);
            const fileUrl = pengajuan.file_pdf 
                ? `/storage/${pengajuan.file_pdf}` 
                : null;

            if (fileUrl) {
                $('#file_pdf').html(`<a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Lihat PDF</a>`);
            } else {
                $('#file_pdf').text('-');
            }
        }).fail(() => alert('Gagal memuat data.'));
    });
});
</script>
@endsection
