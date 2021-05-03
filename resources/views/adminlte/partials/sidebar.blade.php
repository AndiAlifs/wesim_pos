<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('/logoWesim.png') }}" alt="Logo Wesim"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-4">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('report') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>


                @if (auth()->user()->role_id == 2)
                    <li class="nav-item">
                        <a href="{{ route('user') }}" class="nav-link {{ Route::is('user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endif


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ Route::is('finance', 'purchase', 'selling') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display:  {{ Route::is('finance', 'purchase', 'selling') ? 'block' : '' }}">
                        <li class="nav-item pl-3">
                            <a href="{{ __('purchase') }}"
                                class="nav-link {{ Route::is('purchase') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-pdf"></i>
                                <p>
                                    Pembelian
                                </p>
                            </a>
                        </li>
                        <li class="nav-item pl-3">
                            <a href="{{ __('selling') }}"
                                class="nav-link {{ Route::is('selling') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-pdf"></i>
                                <p>
                                    Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item pl-3">
                            <a href="{{ __('finance') }}"
                                class="nav-link {{ Route::is('finance') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-file-pdf"></i>
                                <p>
                                    Informasi Keuangan
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('member') }}" class="nav-link {{ Route::is('member') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Member
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('supplier') }}"
                        class="nav-link {{ Route::is('supplier') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            Pemasok
                        </p>
                    </a>
                </li>

                <li class="nav-header">Produk</li>
                <li class="nav-item">
                    <a href="{{ route('product') }}" class="nav-link {{ Route::is('product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('price') }}" class="nav-link {{ Route::is('price') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-print"></i>
                        <p>
                            Riwayat Harga
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('category') }}"
                        class="nav-link {{ Route::is('category') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Kategori Produk
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ __('inventory') }}" class="nav-link {{ Route::is('inventory') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Gudang
                        </p>
                    </a>
                </li>

                @if (auth()->user()->role_id == 1)
                    <li class="nav-item">
                        <a href="{{ route('discount') }}"
                            class="nav-link {{ Route::is('discount') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-percent"></i>
                            <p>
                                Manajemen Diskon
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">Pembelian</li>
                <li class="nav-item">
                    <a href="{{ __('preorder') }}"
                        class="nav-link {{ Route::is('preorder', 'preorder_cashier') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>
                            Pre Order (PO)
                        </p>
                    </a>
                </li>



                {{-- <li class="nav-item">
      <a href="{{__('report')}}" class="nav-link">
        <i class="nav-icon fa fa-file"></i>
        <p>
          Laporan
        </p>
      </a>
    </li> --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
