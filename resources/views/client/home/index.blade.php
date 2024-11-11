@extends('layouts.client')
@section('title')
    SHOPINGO Store - Thời trang Việt Nam
@endsection
@section('contents')
    @include('client.home.slider-section')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start information-->
            <section class="py-4">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-center p-3 border">
                                <div class="fs-1 text-content"><i class='bx bx-taxi'></i>
                                </div>
                                <div class="info-box-content ps-3">
                                    <h6 class="mb-0 fw-bold">MIỄN PHÍ VẬN CHUYỂN &amp; ĐỔI TRẢ</h6>
                                    <p class="mb-0">Giao hàng miễn phí cho tất cả các đơn hàng trên $ 199</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center justify-content-center p-3 border">
                                <div class="fs-1 text-content"><i class='bx bx-dollar-circle'></i>
                                </div>
                                <div class="info-box-content ps-3">
                                    <h6 class="mb-0 fw-bold">ĐẢM BẢO HOÀN TIỀN</h6>
                                    <p class="mb-0">Đảm bảo hoàn tiền 100% khi hủy đơn hàng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-center p-3 border">
                                <div class="fs-1 text-content"><i class='bx bx-support'></i>
                                </div>
                                <div class="info-box-content ps-3">
                                    <h6 class="mb-0 fw-bold">HỖ TRỢ TRỰC TUYẾN 24/7</h6>
                                    <p class="mb-0">Hỗ trợ tuyệt vời trong 24/7 ngày</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end information-->
            <!--start pramotion-->
            <section class="py-4">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4">
                        <div class="col">
                            <div class="card rounded-0 shadow-none bg-info bg-opacity-25">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <img src="{{ asset('theme/client/images/promo/01.png') }}" class="img-fluid"
                                            alt="" />
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase fw-bold">Men Wear</h5>
                                            <p class="card-text text-uppercase">Starting at $9</p>
                                            <a href="javascript:;" class="btn btn-outline-dark btn-ecomm">SHOP
                                                NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-0 shadow-none bg-danger bg-opacity-25">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <img src="{{ asset('theme/client/images/promo/02.png') }}" class="img-fluid"
                                            alt="" />
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase fw-bold">Women Wear</h5>
                                            <p class="card-text text-uppercase">Starting at $9</p> <a href="javascript:;"
                                                class="btn btn-outline-dark btn-ecomm">SHOP
                                                NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-0 shadow-none bg-warning bg-opacity-25">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <img src="{{ asset('theme/client/images/promo/03.png') }}" class="img-fluid"
                                            alt="" />
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase fw-bold">Kids Wear</h5>
                                            <p class="card-text text-uppercase">Starting at $9</p><a href="javascript:;"
                                                class="btn btn-outline-dark btn-ecomm">SHOP
                                                NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end pramotion-->
            <!--start Featured product-->
            @include('client.home.featured-products')
            <!--end Featured product-->
            <!--start Advertise banners-->
            @include('client.home.advertise-banners')
            <!--end Advertise banners-->
            <!--start support info-->
            @include('client.home.support-info')
            <!--end support info-->
            <!--start News-->
            <section class="py-4">
                <div class="container">
                    <div class="pb-4 text-center">
                        <h5 class="mb-0 fw-bold text-uppercase">Latest News</h5>
                    </div>
                    <div class="product-grid">
                        <div class="latest-news owl-carousel owl-theme">
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="{{ asset('theme/client/images/blogs/01.png') }}"
                                            class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...
                                        </p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="{{ asset('theme/client/images/blogs/02.png') }}"
                                            class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...
                                        </p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="{{ asset('theme/client/images/blogs/03.png') }}"
                                            class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...
                                        </p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="{{ asset('theme/client/images/blogs/04.png') }}"
                                            class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...
                                        </p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="{{ asset('theme/client/images/blogs/05.png') }}"
                                            class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...
                                        </p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card rounded-0 product-card border">
                                    <div class="news-date">
                                        <div class="date-number">24</div>
                                        <div class="date-month">FEB</div>
                                    </div>
                                    <a href="javascript:;">
                                        <img src="{{ asset('theme/client/images/blogs/06.png') }}"
                                            class="card-img-top border-bottom" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <div class="news-title">
                                            <a href="javascript:;">
                                                <h5 class="mb-3 text-capitalize">Blog Short Title</h5>
                                            </a>
                                        </div>
                                        <p class="news-content mb-0">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Cras non placerat mi. Etiam non tellus sem. Aenean...
                                        </p>
                                    </div>
                                    <div class="card-footer border-top bg-transparent">
                                        <a href="javascript:;" class="link-dark">0 Comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end News-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
