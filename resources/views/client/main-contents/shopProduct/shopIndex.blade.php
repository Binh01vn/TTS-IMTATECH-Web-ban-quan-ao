@extends('layouts.client')
@section('title')
    SHOPINGO ALL PRODUCTS
@endsection

@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Shop Products</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shopHome') }}">
                                            <i class="bx bx-home-alt"></i>Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Shop</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Shop Products</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop area-->
            <section class="py-4">
                <div class="container">
                    <div class="btn btn-dark btn-ecomm d-xl-none position-fixed top-50 start-0 translate-middle-y z-index-1"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarFilter">
                        <span>
                            <i class='bx bx-filter-alt me-1'></i>Filters
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-3 filter-column">
                            <nav class="navbar navbar-expand-xl flex-wrap p-0">
                                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarFilter"
                                    aria-labelledby="offcanvasNavbarFilterLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title mb-0 fw-bold" id="offcanvasNavbarFilterLabel">
                                            Filters
                                        </h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="filter-sidebar">
                                            <div class="card rounded-0 shadow-none border">
                                                <div class="card-header d-none d-xl-block bg-transparent">
                                                    <h5 class="mb-0 fw-bold">Filters</h5>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="p-1 fw-bold bg-light">Categories</h6>
                                                    <div class="categories">
                                                        <div class="categories-wrapper height-1 p-1">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate1">
                                                                <label class="form-check-label" for="chekCate1">
                                                                    <span>Shirts</span><span
                                                                        class="product-number">(1548)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate2">
                                                                <label class="form-check-label" for="chekCate2">
                                                                    <span>Jeans</span><span
                                                                        class="product-number">(568)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate3">
                                                                <label class="form-check-label" for="chekCate3">
                                                                    <span>Kurtas</span><span
                                                                        class="product-number">(784)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate4">
                                                                <label class="form-check-label" for="chekCate4">
                                                                    <span>Makeup</span><span
                                                                        class="product-number">(1789)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate5">
                                                                <label class="form-check-label" for="chekCate5">
                                                                    <span>Shoes</span><span
                                                                        class="product-number">(358)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate6">
                                                                <label class="form-check-label" for="chekCate6">
                                                                    <span>Heels</span><span
                                                                        class="product-number">(572)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate7">
                                                                <label class="form-check-label" for="chekCate7">
                                                                    <span>Lehenga</span><span
                                                                        class="product-number">(754)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate8">
                                                                <label class="form-check-label" for="chekCate8">
                                                                    <span>Laptops</span><span
                                                                        class="product-number">(541)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate9">
                                                                <label class="form-check-label" for="chekCate9">
                                                                    <span>Jewellary</span><span
                                                                        class="product-number">(365)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate10">
                                                                <label class="form-check-label" for="chekCate10">
                                                                    <span>Sports</span><span
                                                                        class="product-number">(4512)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate11">
                                                                <label class="form-check-label" for="chekCate11">
                                                                    <span>Music</span><span
                                                                        class="product-number">(647)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate12">
                                                                <label class="form-check-label" for="chekCate12">
                                                                    <span>Headphones</span><span
                                                                        class="product-number">(9848)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate13">
                                                                <label class="form-check-label" for="chekCate13">
                                                                    <span>Sunglasses</span><span
                                                                        class="product-number">(751)</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="chekCate14">
                                                                <label class="form-check-label" for="chekCate14">
                                                                    <span>Belts</span><span
                                                                        class="product-number">(4923)</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="Price">
                                                        <h6 class="p-1 fw-bold bg-light">Price</h6>
                                                        <div class="Price-wrapper p-1">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control rounded-0"
                                                                    placeholder="$10">
                                                                <span
                                                                    class="input-group-text bg-section-1 border-0">-</span>
                                                                <input type="text" class="form-control rounded-0"
                                                                    placeholder="$10000">
                                                                <button type="button"
                                                                    class="btn btn-outline-dark rounded-0 ms-2"><i
                                                                        class='bx bx-chevron-right me-0'></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="sizes">
                                                        <h6 class="p-1 fw-bold bg-light">Sizes</h6>
                                                        <div class="color-wrapper height-1 p-1">
                                                            @foreach ($sizes as $item)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $item->id }}" id="chekCate1">
                                                                    <label class="form-check-label" for="chekCate1">
                                                                        <span>{{ $item->sizeValue }}</span>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="colors">
                                                        <h6 class="p-1 fw-bold bg-light">Colors</h6>
                                                        <div class="color-wrapper height-1 p-1">
                                                            @foreach ($colors as $item)
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-text">
                                                                        <input class="form-check-input mt-0"
                                                                            type="checkbox" value="{{ $item->id }}">
                                                                    </div>
                                                                    <input type="color"
                                                                        class="form-control form-control-color"
                                                                        value="{{ $item->colorValue }}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="col-12 col-xl-9">
                            <div class="product-wrapper">
                                <div class="product-grid">
                                    <div
                                        class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3 g-3 g-sm-4">
                                        @foreach ($dataPrdAll as $item)
                                            <div class="col">
                                                <div class="card">
                                                    <div class="position-relative overflow-hidden">
                                                        <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                                            <a href="{{ route('shop.detail', $item->slug) }}">Product
                                                                Detail</a>
                                                        </div>
                                                        <a href="javascript:;">
                                                            <img src="{{ \Storage::url($item->image_thumbnail) }}"
                                                                class="img-fluid" alt=".....">
                                                        </a>
                                                    </div>
                                                    <div class="card-body px-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div style="padding: 3px;">
                                                                <h6 class="mb-0 fw-bold product-short-title">
                                                                    {{ $item->name }}
                                                                    {!! $item->sale_percent > 0 ? "(-$item->sale_percent%)" : '' !!}
                                                                </h6>
                                                            </div>
                                                            <div class="icon-wishlist">
                                                                <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="cursor-pointer rating mt-2">
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        </div>
                                                        <div
                                                            class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                            @if ($item->sale_percent > 0 || $item->price_sale > 0)
                                                                <div
                                                                    class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                                    {{ number_format((int) $item->price_default, 0, ',', '.') }}
                                                                </div>
                                                            @endif
                                                            <div class="h6 fw-bold">
                                                                {{ number_format((int) ($item->sale_percent > 0 ? $item->price_default * (1 - $item->sale_percent / 100) : ($item->price_sale > 0 ? $item->price_sale : $item->price_default)), 0, ',', '.') }}
                                                                (VND)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                {{ $dataPrdAll->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end shop area-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
