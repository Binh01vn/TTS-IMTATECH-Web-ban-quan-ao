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
                            <li class="nav-item"><a href="wishlist.html" class="nav-link cart-link"><i
                                        class='bx bx-heart'></i></a>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <a href="#"
                                    class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link"
                                    data-bs-toggle="dropdown"> <span class="alert-count">8</span>
                                    <i class='bx bx-shopping-bag'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="cart-header">
                                            <p class="cart-header-title mb-0">8 ITEMS</p>
                                            <p class="cart-header-clear ms-auto mb-0">VIEW CART</p>
                                        </div>
                                    </a>
                                    <div class="cart-list">
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Men White T-Shirt</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/01.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Puma Sports Shoes</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/05.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Women Red Sneakers</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/17.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Black Headphone</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/10.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Blue Girl Shoes</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/08.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Men Leather Belt</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/18.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Men Yellow T-Shirt</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/04.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title">Pool Charir</h6>
                                                    <p class="cart-product-price">1 X $29.00</p>
                                                </div>
                                                <div class="position-relative">
                                                    <div class="cart-product-cancel position-absolute"><i
                                                            class='bx bx-x'></i>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img src="{{ asset('theme/client/images/products/16.png') }}"
                                                            class="" alt="product image">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <a href="javascript:;">
                                        <div class="text-center cart-footer d-flex align-items-center">
                                            <h5 class="mb-0">TOTAL</h5>
                                            <h5 class="mb-0 ms-auto">$189.00</h5>
                                        </div>
                                    </a>
                                    <div class="d-grid p-3 border-top"> <a href="javascript:;"
                                            class="btn btn-dark btn-ecomm">CHECKOUT</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
