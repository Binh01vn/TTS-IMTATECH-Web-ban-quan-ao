<div class="top-menu">
    <div class="container">
        <nav class="navbar navbar-expand">
            <div class="shiping-title d-none d-sm-flex">Welcome to our Shopingo store!</div>
            <ul class="navbar-nav ms-auto d-none d-lg-flex">
                @if (Route::has('auth.login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">My Account</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                        </li>

                        @if (Route::has('auth.register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </nav>
    </div>
</div>
