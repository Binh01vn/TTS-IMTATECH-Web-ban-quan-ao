<div class="primary-menu">
    <nav class="navbar navbar-expand-xl w-100 navbar-dark container mb-0 p-0">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <div class="offcanvas-logo"><img src="{{ asset('theme/client/images/logo-icon.png') }}" width="100"
                        alt="">
                </div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body primary-menu">
                <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shopHome') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="tv-shows.html"
                            data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <div class="dropdown-menu dropdown-large-menu">
                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <h6 class="large-menu-title">Fashion</h6>
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;">Casual T-Shirts</a>
                                        </li>
                                        <li><a href="javascript:;">Formal Shirts</a>
                                        </li>
                                        <li><a href="javascript:;">Jackets</a>
                                        </li>
                                        <li><a href="javascript:;">Jeans</a>
                                        </li>
                                        <li><a href="javascript:;">Dresses</a>
                                        </li>
                                        <li><a href="javascript:;">Sneakers</a>
                                        </li>
                                        <li><a href="javascript:;">Belts</a>
                                        </li>
                                        <li><a href="javascript:;">Sports Shoes</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end col-3 -->
                                <div class="col-12 col-xl-4">
                                    <h6 class="large-menu-title">Electronics</h6>
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;">Mobiles</a>
                                        </li>
                                        <li><a href="javascript:;">Laptops</a>
                                        </li>
                                        <li><a href="javascript:;">Macbook</a>
                                        </li>
                                        <li><a href="javascript:;">Televisions</a>
                                        </li>
                                        <li><a href="javascript:;">Lighting</a>
                                        </li>
                                        <li><a href="javascript:;">Smart Watch</a>
                                        </li>
                                        <li><a href="javascript:;">Galaxy Phones</a>
                                        </li>
                                        <li><a href="javascript:;">PC Monitors</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end col-3 -->
                                <div class="col-12 col-xl-4 d-none d-xl-block">
                                    <div class="pramotion-banner1">
                                        <img src="{{ asset('theme/client/images/gallery/menu-img.jpg') }}"
                                            class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <!-- end col-3 -->
                            </div>
                            <!-- end row -->
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            Shop <i class='bx bx-chevron-down ms-1'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropdown"><a
                                    class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" href="#">Shop
                                    Layouts <i class='bx bx-chevron-right float-end'></i></a>
                                <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" href="shop-grid-left-sidebar.html">Shop
                                            Grid - Left Sidebar</a>
                                    </li>
                                    <li><a class="dropdown-item" href="shop-grid-right-sidebar.html">Shop
                                            Grid - Right Sidebar</a>
                                    </li>
                                    <li><a class="dropdown-item" href="shop-list-left-sidebar.html">Shop
                                            List - Left Sidebar</a>
                                    </li>
                                    <li><a class="dropdown-item" href="shop-list-right-sidebar.html">Shop
                                            List - Right Sidebar</a>
                                    </li>
                                    <li><a class="dropdown-item" href="shop-grid-filter-on-top.html">Shop
                                            Grid - Top Filter</a>
                                    </li>
                                    <li><a class="dropdown-item" href="shop-list-filter-on-top.html">Shop
                                            List - Top Filter</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="product-details.html">Product Details</a>
                            </li>
                            <li><a class="dropdown-item" href="shop-cart.html">Shop Cart</a>
                            </li>
                            <li><a class="dropdown-item" href="shop-categories.html">Shop Categories</a>
                            </li>
                            <li><a class="dropdown-item" href="checkout-details.html">Billing Details</a>
                            </li>
                            <li><a class="dropdown-item" href="checkout-shipping.html">Checkout
                                    Shipping</a>
                            </li>
                            <li><a class="dropdown-item" href="checkout-payment.html">Payment Method</a>
                            </li>
                            <li><a class="dropdown-item" href="checkout-review.html">Order Review</a>
                            </li>
                            <li><a class="dropdown-item" href="checkout-complete.html">Checkout
                                    Complete</a>
                            </li>
                            <li><a class="dropdown-item" href="order-tracking.html">Order Tracking</a>
                            </li>
                            <li><a class="dropdown-item" href="product-comparison.html">Product
                                    Comparison</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about-us.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.html">Contact</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="shop-categories.html">Our Store</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            Blog
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="blog-post.html">Blog Post</a></li>
                            <li><a class="dropdown-item" href="blog-read.html">Blog Read</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
