@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daftar Pengajuan Aset</h3>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.pengajuan.create') }}" class="btn btn-primary mb-3">Buat Pengajuan</a>

    @if ($pengajuan->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>Belum ada pengajuan</strong>
        </div>
    @else
        <table class="table table-bordered custom-table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
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
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->departemen }}</td>
                    <td>{{ $p->tanggal_pemohon }}</td>
                    <td>{{ $p->perihal }}</td>
                    <td>{{ Str::limit($p->deskripsi, 50) }}</td>
                    <td>
                        @if($p->status_vp == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($p->status_vp == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if ($p->deskripsi_status_vp)
                            {{ $p->deskripsi_status_vp }}
                        @else
                            <span class="text-danger fst-italic">VP belum memberikan catatan</span>
                        @endif
                    </td>
                    <td>
                        @if($p->status_bpo == 'sedang diproses')
                            <span class="badge bg-warning text-dark">Sedang diproses</span>
                        @elseif($p->status_bpo == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-secondary">Belum diproses</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm lihat-deskripsi" data-id="{{ $p->id }}" data-bs-toggle="modal" data-bs-target="#modalDetail">
                            <i class="bi bi-eye"></i> Lihat Deskripsi
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Modal Detail Pengajuan -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalDetailLabel">
                    <i class="bi bi-file-earmark-text"></i> Detail Pengajuan Aset
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Informasi Pengajuan -->
                <h5 class="fw-bold mb-3 text-primary">Informasi Pengajuan</h5>
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <tbody>
                                    <tr>
                                        <th class="text-start">Nama Pengaju</th>
                                        <td id="nama_pengaju"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Departemen</th>
                                        <td id="departemen"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Tanggal Pemohon</th>
                                        <td id="tanggal_pemohon"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Perihal</th>
                                        <td id="perihal"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Deskripsi</th>
                                        <td id="deskripsi"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Status VP</th>
                                        <td>
                                            <span id="status_vp" class="badge"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Catatan VP</th>
                                        <td id="deskripsi_status_vp"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-start">Status BPO</th>
                                        <td>
                                            <span id="status_bpo" class="badge"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Detail Aset -->
                <h5 class="fw-bold mb-3 text-primary">Detail Aset yang Diajukan</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered custom-table">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Kategori Aset</th>
                                <th>Nama Aset</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="aset_list"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- AJAX untuk Mengambil Detail Pengajuan -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateStatusBadge(status_vp) {
        let badge = document.getElementById('status_vp');
        
        // Hapus kelas warna sebelumnya
        badge.classList.remove('bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-secondary');

        // Sesuaikan warna berdasarkan status
        switch (status_vp.toLowerCase()) {
            case 'disetujui':
                badge.classList.add('bg-success'); // Hijau
                badge.textContent = 'Disetujui';
                break;
            case 'pending':
                badge.classList.add('bg-warning'); // Kuning
                badge.textContent = 'Pending';
                break;
            case 'ditolak':
                badge.classList.add('bg-danger'); // Merah
                badge.textContent = 'Ditolak';
                break;
            default:
                badge.classList.add('bg-secondary'); // Abu-abu untuk status tidak dikenal
                badge.textContent = '❓ Tidak Diketahui';
                break;
        }
    }

    function updateStatusBadgeBPO(status_bpo) {
        let badge = document.getElementById('status_bpo');
        
        // Hapus kelas warna sebelumnya
        badge.classList.remove('bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-secondary');

        // Sesuaikan warna berdasarkan status
        switch (status_bpo.toLowerCase()) {
            case 'belum diproses':
                badge.classList.add('bg-secondary'); // Hijau
                badge.textContent = 'Belum diproses';
                break;
            case 'sedang diproses':
                badge.classList.add('bg-warning'); // Kuning
                badge.textContent = 'Sedang diproses';
                break;
            case 'selesai':
                badge.classList.add('bg-success'); // Merah
                badge.textContent = 'Selesai';
                break;
            default:
                badge.classList.add('bg-secondary'); // Abu-abu untuk status tidak dikenal
                badge.textContent = '❓ Tidak Diketahui';
                break;
        }
    }

    $(document).on("click", ".lihat-deskripsi", function () {
        let pengajuanId = $(this).data("id");

        $.ajax({
            url: `/admin/pengajuan/${pengajuanId}`,
            type: 'GET',
            success: function(response) {
                console.log(response); // Debugging: Cek data yang diterima

                $('#nama_pengaju').text(response.pengajuan.user.name);
                $('#departemen').text(response.pengajuan.departemen);
                $('#tanggal_pemohon').text(response.pengajuan.tanggal_pemohon);
                $('#perihal').text(response.pengajuan.perihal);
                $('#deskripsi').text(response.pengajuan.deskripsi);
                if (!response.pengajuan.deskripsi_status_vp || response.pengajuan.deskripsi_status_vp.trim() === "") {
                    $('#deskripsi_status_vp').html('<i class="text-danger">VP belum memberikan catatan</i>');
                } else {
                    $('#deskripsi_status_vp').text(response.pengajuan.deskripsi_status_vp);
                }

                updateStatusBadge(response.pengajuan.status_vp);
                updateStatusBadgeBPO(response.pengajuan.status_bpo);

                // Kosongkan daftar aset sebelum menambahkan yang baru
                $('#aset_list').empty();

                // Tambahkan daftar aset ke dalam modal
                response.aset.forEach((item, index) => {
                    $('#aset_list').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.kategori}</td>
                            <td>${item.nama}</td>
                            <td>${item.jumlah}</td>
                        </tr>
                    `);
                });
            },
            error: function(xhr) {
                alert("Gagal mengambil data. Coba lagi.");
            }
        });
    });
</script>

@endsection
