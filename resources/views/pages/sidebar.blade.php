<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('dist/img/LOGO_STIEI.png') }}" alt="AdminLTE Logo" class="brand-image elevation" style="opacity: .8">

    <span class="brand-text font-weight-light">SILAT - STIEI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('dist/img/avatar.png') }}"
          class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('profile.edit') }}" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">AJUKAN</li>
        @if (auth()->user()->hasRole('dosen'))
          <li class="nav-item">
            <a href="{{ route('cuti.create') }}"
              class="nav-link {{ request()->routeIs('cuti.create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pengajuan Cuti
              </p>
            </a>
          </li>
        @endif
        @if (auth()->user()->hasRole('mahasiswa'))
          <li class="nav-item">
            <a href="{{ route('penelitian.create') }}"
              class="nav-link {{ request()->routeIs('penelitian.create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Izin Penelitian
              </p>
            </a>
          </li>
        @endif
        @if (auth()->user()->hasRole('mahasiswa'))
          <li class="nav-item">
            <a href="{{ route('pkl.create') }}"
              class="nav-link {{ request()->routeIs('pkl.create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Praktek Kerja Lapangan
              </p>
            </a>
          </li>
        @endif
        @if (auth()->user()->hasRole('mahasiswa'))
          <li class="nav-item">
            <a href="{{ route('mahasiswaaktif.create') }}"
              class="nav-link {{ request()->routeIs('mahasiswaaktif.create') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Surat Aktif
              </p>
            </a>
          </li>
        @endif
        <li class="nav-header">SURAT</li>
        <li class="nav-item">
          <a href="{{ route('cuti.index') }}" class="nav-link {{ request()->routeIs('cuti.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Surat Pengajuan Cuti
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('penelitian.index') }}"
            class="nav-link {{ request()->routeIs('penelitian.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Surat Izin Penelitian
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pkl.index') }}" class="nav-link {{ request()->routeIs('pkl.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Surat PKL
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('mahasiswaaktif.index') }}"
            class="nav-link {{ request()->routeIs('mahasiswaaktif.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Surat Mahasiswa Aktif
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('suratkeluar.cetak') }}" target="_blank"
            class="nav-link {{ request()->routeIs('suratkeluar.cetak') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Surat Keluar
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!-- /.sidebar -->
