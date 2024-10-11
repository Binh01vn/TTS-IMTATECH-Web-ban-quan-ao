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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.shopIndex') }}">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
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
