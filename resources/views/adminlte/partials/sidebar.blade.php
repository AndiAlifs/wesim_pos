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
          <a href="{{route('home')}}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Beranda
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('user')}}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('member')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Member
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/#" class="nav-link">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>
              Pemasok
            </p>
          </a>
        </li>
        <li class="nav-item  ">
          <a href="{{route('product')}}" class="nav-link">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Produk
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/#" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
              Gudang
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/#" class="nav-link">
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