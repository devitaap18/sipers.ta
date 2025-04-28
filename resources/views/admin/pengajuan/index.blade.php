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

    <div class="row mb-3">
        <div class="col-md-6 mb-2">
            <a href="{{ route('admin.pengajuan.create') }}" class="btn btn-primary">Buat Pengajuan</a>
        </div>
        <div class="col-md-3 mb-2">
            <select id="filter_status_vp" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="disetujui">Disetujui</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" id="search_perihal" class="form-control" placeholder="Cari perihal...">
        </div>
    </div>

    @if ($pengajuan->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>Belum ada pengajuan</strong>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="pengajuan_table">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
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
                            <button class="btn btn-info btn-sm lihat-deskripsi" data-id="{{ $p->id }}" data-bs-toggle="modal" data-bs-target="#modalDetail">
                                <i class="bi bi-eye"></i> Lihat
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mt-3">
            <div class="col-md-6 d-flex align-items-center">
                <span>Menampilkan {{ $pengajuan->firstItem() }} - {{ $pengajuan->lastItem() }} dari {{ $pengajuan->total() }} pengajuan</span>
            </div>
            <div class="col-md-6">
                <nav>
                    <ul class="pagination justify-content-end">
                        {{-- Tombol Previous --}}
                        <li class="page-item {{ $pengajuan->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pengajuan->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Nomor Halaman --}}
                        @for ($i = 1; $i <= $pengajuan->lastPage(); $i++)
                            <li class="page-item {{ $pengajuan->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $pengajuan->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Tombol Next --}}
                        <li class="page-item {{ $pengajuan->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $pengajuan->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    @endif
</div>

<!-- Modal Detail Pengajuan -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-file-earmark-text"></i> Detail Pengajuan</h5>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Filter berdasarkan status VP
        $('#filter_status_vp').change(function () {
            let filter = $(this).val().toLowerCase();
            $('#pengajuan_table tbody tr').filter(function () {
                $(this).toggle($(this).find('.status_vp').text().toLowerCase().indexOf(filter) > -1 || filter == "");
            });
        });

        // Pencarian berdasarkan perihal
        $('#search_perihal').on("keyup", function () {
            let value = $(this).val().toLowerCase();
            $('#pengajuan_table tbody tr').filter(function () {
                $(this).toggle($(this).find('.perihal').text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Menampilkan detail pengajuan ke dalam modal
        $('.lihat-deskripsi').click(function () {
            let id = $(this).data('id');

            $.ajax({
                url: '/admin/pengajuan/' + id, // Sesuaikan dengan route yang digunakan
                type: 'GET',
                success: function (data) {
                    let pengajuan = data.pengajuan;

                    $('#nama_pengaju').text(pengajuan.user.name);
                    $('#departemen').text(pengajuan.departemen);
                    $('#tanggal_pemohon').text(pengajuan.tanggal_pemohon);
                    $('#perihal').text(pengajuan.perihal);
                    $('#deskripsi').text(pengajuan.deskripsi);
                    $('#deskripsi_status_vp').text(pengajuan.deskripsi_status_vp || 'VP belum memberikan catatan');

                    // Status VP
                    let status_vp = pengajuan.status_vp;
                    $('#status_vp').removeClass().addClass('badge bg-' + (status_vp === 'disetujui' ? 'success' : status_vp === 'pending' ? 'warning text-dark' : 'danger')).text(status_vp.charAt(0).toUpperCase() + status_vp.slice(1));

                    // Status BPO
                    let status_bpo = pengajuan.status_bpo;
                    $('#status_bpo').removeClass().addClass('badge bg-' + (status_bpo === 'selesai' ? 'success' : status_bpo === 'sedang diproses' ? 'warning text-dark' : 'secondary')).text(status_bpo.charAt(0).toUpperCase() + status_bpo.slice(1));

                    // Detail Aset
                    let asetHtml = '';
                    data.aset.forEach((aset, index) => {
                        asetHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${aset.kategori}</td>
                                <td>${aset.nama}</td>
                                <td>${aset.jumlah}</td>
                            </tr>
                        `;
                    });

                    $('#aset_list').html(asetHtml);
                    $('#modalDetail').modal('show');
                },
                error: function () {
                    alert('Gagal mengambil data pengajuan.');
                }
            });
        });
    });
</script>

@endsection