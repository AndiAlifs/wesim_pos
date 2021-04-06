<nav class="navbar navbar-expand navbar-white navbar-light my-nav">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <h2><a class="nav-link" href="#">WESIM | KASIR</a></h2>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @guest
            <li class="nav-item">
                <b class="nav-link">Your Guest</b>
            </li>
        @else

            <li class="nav-item">
                <a href="{{ route('cashier') }}" class="nav-link {{ Route::is('cashier') ? 'text-primary' : '' }}">
                    <i class="nav-icon fas fa-cart-plus"></i>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#" class="nav-link" id="reputasi"><i class="nav-icon fas fa-balance-scale"></i></a>
            </li> --}}
            <li class="nav-item">
                <a href="{{ route('transaction_today') }}"
                    class="nav-link {{ Route::is('transaction_today') ? 'text-primary' : '' }}">
                    <i class="nav-icon fas fa-history"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="reputasi"></a>
            </li>

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <input type="hidden" value="{{ Auth::user()->id }}" id="user-id">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a></a>
                    User Profile
                    </a>
                </div>
            </li>
        @endguest

    </ul>
</nav>
