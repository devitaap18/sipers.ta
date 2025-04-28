<div id="sidebar" class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ url(Auth::user()->role->role_name) . '/dashboard/' }}" 
               class="nav-link {{ request()->is(Auth::user()->role->role_name . '/dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>

        @if(Auth::user()->role->role_name === 'admin')
            <li class="nav-item">
                <a href="{{ url('/admin/pengajuan') }}" 
                   class="nav-link {{ request()->is('admin/pengajuan') ? 'active' : '' }}">
                    <i class="fa fa-file-alt me-2"></i>
                    <span class="sidebar-text">Pengajuan</span>
                </a>
            </li>
        @elseif(Auth::user()->role->role_name === 'vp')
            <li class="nav-item">
                <a href="{{ url('/vp/daftar_ajuan') }}" 
                   class="nav-link {{ request()->is('vp/daftar_ajuan') ? 'active' : '' }}">
                    <i class="fa fa-check me-2"></i>
                    <span class="sidebar-text">Daftar Ajuan</span>
                </a>
            </li>
        @elseif(Auth::user()->role->role_name === 'bpo')
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
        @elseif(Auth::user()->role->role_name === 'superadmin')
            <li class="nav-item">
                <a href="{{ url('/superadmin/user') }}" 
                   class="nav-link {{ request()->is('superadmin/user') ? 'active' : '' }}">
                    <i class="fa fa-users me-2"></i>
                    <span class="sidebar-text">Kelola User</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/superadmin/role') }}" 
                   class="nav-link {{ request()->is('superadmin/role') ? 'active' : '' }}">
                    <i class="fa fa-user-shield me-2"></i>
                    <span class="sidebar-text">Kelola Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/superadmin/menu') }}" 
                   class="nav-link {{ request()->is('superadmin/menu') ? 'active' : '' }}">
                    <i class="fa fa-bars me-2"></i>
                    <span class="sidebar-text">Kelola Menu</span>
                </a>
            </li>
        @endif
    </ul>
</div>
