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

                <li class="nav-item">
                    <a class="nav-link" href="shop-categories.html">Our Stores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;">Help & FAQs</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
