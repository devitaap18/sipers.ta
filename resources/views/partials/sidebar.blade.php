<div id="sidebar" class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ url(Auth::user()->role) . '/dashboard/' }}" 
               class="nav-link {{ request()->is(Auth::user()->role . '/dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a href="{{ url('/admin/pengajuan') }}" 
                   class="nav-link {{ request()->is('admin/pengajuan') ? 'active' : '' }}">
                    <i class="fa fa-file-alt me-2"></i>
                    <span class="sidebar-text">Pengajuan</span>
                </a>
            </li>
        @elseif(Auth::user()->role === 'vp')
            <li class="nav-item">
                <a href="{{ url('/vp/daftar_ajuan') }}" 
                   class="nav-link {{ request()->is('vp/daftar_ajuan') ? 'active' : '' }}">
                    <i class="fa fa-check me-2"></i>
                    <span class="sidebar-text">Daftar Ajuan</span>
                </a>
            </li>
        @elseif(Auth::user()->role === 'bpo')
            <li class="nav-item">
                <a href="{{ url('/bpo/pengajuan') }}" 
                   class="nav-link {{ request()->is('bpo/pengajuan') ? 'active' : '' }}">
                    <i class="fa fa-folder me-2"></i>
                    <span class="sidebar-text">Pengajuan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/bpo/kelola_aset') }}" 
                   class="nav-link {{ request()->is('bpo/kelola_aset') ? 'active' : '' }}">
                    <i class="fa fa-tasks me-2"></i>
                    <span class="sidebar-text">Aset</span>
                </a>
            </li>
        @elseif(Auth::user()->role === 'superadmin')
            <li class="nav-item">
                <a href="{{ url('/superadmin/kelola-user') }}" 
                   class="nav-link {{ request()->is('superadmin/kelola-user') ? 'active' : '' }}">
                    <i class="fa fa-users me-2"></i>
                    <span class="sidebar-text">Kelola User</span>
                </a>
            </li>
        @endif
    </ul>
</div>
