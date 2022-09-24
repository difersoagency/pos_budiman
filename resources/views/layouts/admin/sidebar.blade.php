<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light tw-bg-prim-blue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars tw-text-prim-white"></i></a>
        </li>
    </ul>


</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4 tw-bg-prim-black">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- SidebarSearch Form -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/images/logombm.png') }}" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="#" class="d-block tw-text-prim-white tw-font-bold">PT.Maju Bersama Motor</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari menu" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>


        <nav class="tw-mt-6">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/home/{{ Auth::user()->LevelUser->nama_level }}" class="nav-link ">
                        <i class="nav-icon fa fa-home tw-text-prim-white"></i>
                        <p class="tw-text-prim-red tw-font-bold active-link">
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (in_array(Auth::user()->LevelUser->nama_level, ['admin']))
                <li class="nav-item has-submenu">
                    <a href="master" class="tw-cursor-pointer nav-link">
                        <i class="nav-icon fa fa-globe tw-text-prim-white"></i>
                        <p class="tw-text-prim-red tw-font-bold focus:tw-text-prim-white">
                            Master
                        </p>
                    </a>
                </li>
                <li class="nav-item has-submenu">
                    <a class="tw-cursor-pointer nav-link">
                        <i class="nav-icon fa fa-credit-card tw-text-prim-white"></i>
                        <p class="tw-text-prim-red tw-font-bold focus:tw-text-prim-white">
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('barang') }}" class="nav-link">
                        <i class="nav-icon fa fa-barcode tw-text-prim-white"></i>
                        <p class="tw-text-prim-red tw-font-bold">
                            Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item has-submenu">
                    <a class="tw-cursor-pointer nav-link">
                        <i class="nav-icon fa fa-file tw-text-prim-white"></i>
                        <p class="tw-text-prim-red tw-font-bold focus:tw-text-prim-white">
                            Laporan
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-times-circle tw-text-red-500"></i>
                        <p class="tw-text-prim-white">Log Out</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>