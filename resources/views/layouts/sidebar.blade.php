
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ ucwords(auth()->user()->nama) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview {{ in_array(request()->segment(2), ['absensi','kegiatan','anggota','ketua'] ) || request()->segment(1)=='absensi' ? 'menu-open' : null }}">
            <a href="#" class="nav-link {{ in_array(request()->segment(2), ['absensi','kegiatan','anggota','ketua'] ) || request()->segment(1)=='absensi' ? 'active' : null }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('manajemen.kegiatan.index') }}" class="nav-link {{ request()->segment(2) == 'kegiatan' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kegiatan</p>
                </a>
              </li>
              
              @can('absensi')
              <li class="nav-item">
                <a href="{{ route('absensi.index') }}" class="nav-link {{ request()->segment(1)=='absensi' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Absensi</p>
                </a>
              </li>
              @endcan           

              @can('absensi-list')
              <li class="nav-item">
                <a href="{{ route('manajemen.absensi.index') }}" class="nav-link {{ request()->segment(2)=='absensi' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absensi</p>
                </a>
              </li>
              @endcan

              @can('ganti-ketua')
              <li class="nav-item">
                <a href="{{ route('manajemen.ketua.index') }}" class="nav-link {{ request()->segment(2) == 'ketua' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ketua</p>
                </a>
              </li>
              @endcan

              @can('anggota-list')
              <li class="nav-item">
                <a href="{{ route('manajemen.anggota.index') }}" class="nav-link {{ request()->segment(2) == 'anggota' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Anggota</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          @can('manajemen-user')
          <li class="nav-item">
            <a href="{{ route('manajemen.user.index') }}" class="nav-link {{ request()->segment(2) == 'user' ? 'active' : null }}">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Manajemen User
              </p>
            </a>
          </li>
          @endcan

          @can('keuangan')
          <li>
            <a href="{{ route('manajemen.keuangan.index') }}" class="nav-link {{ request()->segment(2) == 'keuangan' ? 'active' : null }}">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Manajemen Keuangan
              </p>
            </a>
          </li>
          @endcan

          @can('manajemen-role')
          <li class="nav-item has-treeview {{ in_array(request()->segment(2), ['role','permission'] ) ? 'menu-open' : null }}">
            <a href="#" class="nav-link {{ in_array(request()->segment(2), ['role','permission'] ) ? 'active' : null }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Role & Permission
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('manajemen.role.index') }}" class="nav-link {{ request()->segment(2) == 'role' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('manajemen.permission.index') }}" class="nav-link {{ request()->segment(2) == 'permission' ? 'active' : null }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permission</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>