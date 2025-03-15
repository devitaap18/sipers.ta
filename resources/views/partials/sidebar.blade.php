<div id="sidebar" class="bg-light sidebar vh-100 position-fixed shadow">
    <ul class="nav flex-column p-3">
        <li class="nav-item">
            <a href="{{ url(Auth::user()->role) . '/dashboard/'}}" class="nav-link">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a href="{{ url('/admin/pengajuan') }}" class="nav-link">
                    <i class="fa fa-file-alt"></i> Pengajuan
                </a>
            </li>

        @elseif(Auth::user()->role === 'vp')
            <li class="nav-item">
                <a href="{{ url('/vp/daftar_ajuan') }}" class="nav-link">
                    <i class="fa fa-check"></i> Daftar Ajuan
                </a>
            </li>

        @elseif(Auth::user()->role === 'bpo')
            <li class="nav-item">
                <a href="{{ url('/bpo/pengajuan') }}" class="nav-link">
                    <i class="fa fa-folder"></i> Pengajuan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/bpo/kelola_aset') }}" class="nav-link">
                    <i class="fa fa-tasks"></i> Aset
                </a>
            </li>
        @endif
    </ul>
</div>
