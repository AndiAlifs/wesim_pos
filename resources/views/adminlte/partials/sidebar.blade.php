<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
    <img src="{{asset('/adminlte/dist/img/67Dev.jpg')}}"
        alt="67 Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">{{env("APP_NAME")}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Dashboard</li>
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link {{Route::is('home') ? 'active' : ''}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Beranda
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('user')}}" class="nav-link {{Route::is('user') ? 'active' : ''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{__('finance')}}" class="nav-link {{Route::is('finance') ? 'active' : ''}}">
            <i class="nav-icon fa fa-file"></i>
            <p>
              Informasi Keuangan
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('member')}}" class="nav-link {{Route::is('member') ? 'active' : ''}}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Member
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/supplier" class="nav-link {{Route::is('supplier') ? 'active' : ''}}">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>
              Pemasok
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('product')}}" class="nav-link {{Route::is('product') ? 'active' : ''}}">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Produk
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('discount')}}" class="nav-link {{Route::is('discount') ? 'active' : ''}}">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Manajemen Diskon
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('category')}}" class="nav-link {{Route::is('category') ? 'active' : ''}}">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Kategori Produk
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/#" class="nav-link {{Route::is('warehouse') ? 'active' : ''}}">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
              Gudang
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/#" class="nav-link {{Route::is('report') ? 'active' : ''}}">
            <i class="nav-icon fa fa-file"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>