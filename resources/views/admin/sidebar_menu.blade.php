<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ url('administrator/dashboard/') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-data" aria-expanded="false" aria-controls="ui-data">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">Pengguna</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-data">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/pengguna/internal') }}">Admin</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/pengguna/user') }}">User</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-invest" aria-expanded="false" aria-controls="ui-invest">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Investasi Internet</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-invest">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/investasi-internet/pengajuan-investor') }}">Pengajuan Investor</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/investasi-internet/data-investasi') }}">Data Investasi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/investasi-internet/mutasi-investor') }}">Investor</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/investasi-internet/penarikan-saldo') }}">Penarikan Saldo</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-proyek" aria-expanded="false" aria-controls="ui-proyek">
          <i class="icon-layers menu-icon"></i>
          <span class="menu-title">Proyek Investasi</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-proyek">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/proyek-investasi/data-proyek') }}">Data Proyek</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/proyek-investasi/dokumentasi') }}">Dokumentasi Proyek</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/proyek-investasi/jurnal') }}">Jurnal Proyek</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-pengelolaan" aria-expanded="false" aria-controls="ui-pengelolaan">
          <i class="icon-book menu-icon"></i>
          <span class="menu-title">Pengelolaan</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-pengelolaan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/pengelolaan/pelanggan') }}">Pelanggan Internet</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/pengelolaan/tagihan') }}">Tagihan</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/pengelolaan/kegiatan') }}">Kegiatan</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/pengelolaan/pembelian-aset') }}">Pembelian Aset</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/pengelolaan/asset') }}">Aset</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-laporan" aria-expanded="false" aria-controls="ui-laporan">
          <i class="ti-bar-chart menu-icon"></i>
          <span class="menu-title">Laporan</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-laporan">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/laporan/neraca') }}">Neraca Keuangan</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/laporan/kas') }}">Arus Kas</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('administrator/laporan/laba-rugi') }}">Laba Rugi</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ url('administrator/pengajuan-desa') }}">
          <i class="icon-mail menu-icon"></i>
          <span class="menu-title">Pengajuan Desa</span>
        </a>
      </li>
    </ul>
  </nav>
