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
                        <a class="nav-link" href="/">Trang chủ</a>
                    </li>
                    @php
                        $categorizations = \App\Models\Categorization::query()->with('categories')->get();
                    @endphp
                    @foreach ($categorizations as $ctgzn)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                {{ $ctgzn->name }} <i class='bx bx-chevron-down ms-1'></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($ctgzn->categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="javascript:;">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('other-page.about_us') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('other-page.contact_us') }}">Liên hệ</a>
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
