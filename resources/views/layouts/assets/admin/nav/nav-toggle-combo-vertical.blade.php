<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
        </div><a class="navbar-brand" href="{{ route('admin.') }}">
            <div class="d-flex align-items-center py-3"><img class="me-2"
                    src="{{ asset('theme/admin/assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
                    width="40" /><span class="font-sans-serif text-primary">falcon</span></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <span class="nav-link-text ps-1">Bảng điều khiển</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Thương mại điện tử</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.categories.danh_sach') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-layer-group"></span>
                            </span>
                            <span class="nav-link-text ps-1">Danh mục - Phân loại</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#products" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="products">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-luggage-cart"></span>
                            </span>
                            <span class="nav-link-text ps-1">Sản phẩm</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="products">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.show_form') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Thêm sản phẩm</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.list_sp') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Danh sách sản phẩm</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.list_trashed') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Sản phẩm đã xóa</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a class="nav-link" href="{{ route('admin.tags.list_tags') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-tags"></span>
                            </span>
                            <span class="nav-link-text ps-1">Tags</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.attributes.list_tt') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-filter"></span>
                            </span>
                            <span class="nav-link-text ps-1">Thuộc tính</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.coupons.list_mkm') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-ticket-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Mã giảm giá</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Quản lý tài khoản</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('admin.categories.danh_sach') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-layer-group"></span>
                            </span>
                            <span class="nav-link-text ps-1">Danh mục - Phân loại</span>
                        </div>
                    </a>
                    <a class="nav-link dropdown-indicator" href="#products" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="products">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-luggage-cart"></span>
                            </span>
                            <span class="nav-link-text ps-1">Sản phẩm</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="products">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.show_form') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Thêm sản phẩm</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.list_sp') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Danh sách sản phẩm</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.list_trashed') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Sản phẩm đã xóa</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a class="nav-link" href="{{ route('admin.tags.list_tags') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-tags"></span>
                            </span>
                            <span class="nav-link-text ps-1">Tags</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.attributes.list_tt') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-filter"></span>
                            </span>
                            <span class="nav-link-text ps-1">Thuộc tính</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('admin.coupons.list_mkm') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-ticket-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Mã giảm giá</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
