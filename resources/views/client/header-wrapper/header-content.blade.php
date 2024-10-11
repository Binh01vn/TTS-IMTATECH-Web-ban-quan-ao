<div class="header-content bg-warning">
    <div class="container">
        <div class="row align-items-center gx-4">
            <div class="col-auto">
                <div class="d-flex align-items-center gap-3">
                    <div class="mobile-toggle-menu d-inline d-xl-none" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar">
                        <i class="bx bx-menu"></i>
                    </div>
                    <div class="logo">
                        <a href="{{ route('shopHome') }}">
                            <img src="{{ asset('theme/client/images/logo-icon.png') }}" class="logo-icon"
                                alt="" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl order-4 order-xl-0">
                <div class="input-group flex-nowrap pb-3 pb-xl-0">
                    <input type="text" class="form-control w-100 border-dark border border-3"
                        placeholder="Search for Products">
                    <button class="btn btn-dark btn-ecomm border-3" type="button">Search</button>
                </div>
            </div>
            <div class="col-auto ms-auto">
                <div class="top-cart-icons">
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav">
                            @auth
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.index') }}" class="nav-link cart-link">
                                        <i class='bx bx-user'></i>
                                    </a>
                                </li>
                            @endauth
                            <li class="nav-item">
                                <a href="wishlist.html" class="nav-link cart-link">
                                    <i class='bx bx-heart'></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                @if (session()->has('cart') && count(session('cart')) > 0)
                                    <a href="javascript:;"
                                        class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link"
                                        data-bs-toggle="dropdown">
                                        <span class='alert-count'>{{ count(session('cart')) }}</span>
                                        <i class='bx bx-shopping-bag'></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" style="width: 450px;">
                                        <a href="javascript:;">
                                            <div class="cart-header">
                                                <p class='cart-header-title mb-0'>{{ count(session('cart')) }} ITEMS</p>
                                                <p class="cart-header-clear ms-auto mb-0">VIEW CART</p>
                                            </div>
                                        </a>
                                        <div class="cart-list">
                                            @foreach (session('cart') as $item)
                                                <a class="dropdown-item" href="javascript:;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="cart-product-title">{{ $item['name'] }}</h6>
                                                            <p class="cart-product-price">
                                                                {{ $item['quantityPRDC'] }} x
                                                                {{ number_format(
                                                                    (int) ($item['sale_percent'] > 0
                                                                        ? $item['price_default'] * (1 - $item['sale_percent'] / 100)
                                                                        : ($item['price_sale'] > 0
                                                                            ? $item['price_sale']
                                                                            : $item['price_default'])),
                                                                    0,
                                                                    ',',
                                                                    '.',
                                                                ) }}
                                                            </p>
                                                        </div>
                                                        <div class="position-relative">
                                                            <div class="cart-product">
                                                                <img src="{{ \Storage::url($item['image_thumbnail']) }}"
                                                                    class="" alt=".....">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                        <a href="javascript:;">
                                            <div class="text-center cart-footer d-flex align-items-center">
                                                <h5 class="mb-0">TOTAL</h5>
                                                <h5 class="mb-0 ms-auto">
                                                    @if (session()->has('totalAmount'))
                                                        {{ number_format((int) session('totalAmount'), 0, ',', '.') }}
                                                        (VNĐ)
                                                    @endif
                                                </h5>
                                            </div>
                                        </a>
                                        <div class="d-grid p-3 border-top">
                                            <a href="{{ route('cart.shopCart') }}" class="btn btn-dark btn-ecomm">VIEW
                                                CART</a>
                                        </div>
                                    </div>
                                @else
                                    <a href="javascript:;"
                                        class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link"
                                        data-bs-toggle="dropdown">
                                        <span class='alert-count'>0</span>
                                        <i class='bx bx-shopping-bag'></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:;">
                                            <div class="cart-header">
                                                <p class='cart-header-title mb-0'>0 ITEMS</p>
                                                <p class="cart-header-clear ms-auto mb-0">VIEW CART</p>
                                            </div>
                                        </a>
                                        <div class="cart-list">
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h6 class="cart-product-title">
                                                            There are no products in the cart.
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-grid p-3 border-top">
                                            <a href="javascript:;" class="btn btn-dark btn-ecomm">SHOP NOW</a>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
