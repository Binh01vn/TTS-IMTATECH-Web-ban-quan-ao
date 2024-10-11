@extends('layouts.client')
@section('title')
    Product Detail
@endsection
@section('css-setting')
    <style>
        .star-rating {
            direction: rtl;
            /* Đảo ngược thứ tự hiển thị sao */
            font-size: 15px;
            /* Tăng kích thước của các ngôi sao */
            unicode-bidi: bidi-override;
            /* Đảm bảo sự hiển thị sao chính xác */
            display: inline-block;
        }

        .star-rating input[type="radio"] {
            display: none;
            /* Ẩn các radio input */
        }

        .star-rating label {
            color: lightgray;
            /* Màu xám mặc định cho ngôi sao */
            cursor: pointer;
            font-size: 2em;
        }

        .star-rating input[type="radio"]:checked~label {
            color: gold;
            /* Màu vàng khi được chọn */
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: gold;
            /* Màu vàng khi hover */
        }

        /* Đảm bảo các sao trước đó cũng chuyển màu vàng khi người dùng hover */
        .star-rating input[type="radio"]:checked~label:hover,
        .star-rating input[type="radio"]:checked~label:hover~label {
            color: gold;
        }
    </style>
@endsection
@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        @if (session()->has('success'))
                            <h3 class="breadcrumb-title pe-3 text-success">{{ session('success') }}</h3>
                        @else
                            <h3 class="breadcrumb-title pe-3">{{ $dataPrd->name }}</h3>
                        @endif
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shopHome') }}">
                                            <i class="bx bx-home-alt"></i> Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('shop.shopIndex') }}">Shop</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start product detail-->
            <section class="py-4">
                <div class="container">
                    <div class="product-detail-card">
                        <div class="product-detail-body">
                            <div class="row g-0">
                                <div class="col-12 col-lg-5">
                                    <div class="image-zoom-section">
                                        <div class="product-gallery owl-carousel owl-theme border mb-3 p-3"
                                            data-slider-id="1">
                                            <div class="item">
                                                <img src="{{ \Storage::url($dataPrd->image_thumbnail) }}" class="img-fluid"
                                                    alt=".....">
                                            </div>
                                            @foreach ($dataPrd->galleries as $imageG)
                                                <div class="item">
                                                    <img src="{{ \Storage::url($imageG->image) }}" class="img-fluid"
                                                        alt=".....">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                            <button class="owl-thumb-item">
                                                <img src="{{ \Storage::url($dataPrd->image_thumbnail) }}" class=""
                                                    alt=".....">
                                            </button>
                                            @foreach ($dataPrd->galleries as $imageG)
                                                <button class="owl-thumb-item">
                                                    <img src="{{ \Storage::url($imageG->image) }}" class=""
                                                        alt=".....">
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <form action="{{ route('cart.addCart') }}" class="product-info-section p-3"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $dataPrd->slug }}">
                                        <h3 class="mt-3 mt-lg-0 mb-0">{{ $dataPrd->name }}</h3>
                                        @if ($totalReviews > 0)
                                            <div class="product-rating d-flex align-items-center mt-2">
                                                <div class="rates cursor-pointer font-13">
                                                    @for ($i = 0; $i < $averageRating; $i++)
                                                        <i class="bx bxs-star text-warning"></i>
                                                    @endfor
                                                </div>
                                                <div class="ms-1">
                                                    <p class="mb-0">({{ $totalReviews }} Ratings)</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="product-rating d-flex align-items-center mt-2">
                                                <div class="ms-1">
                                                    <p class="mb-0">Chưa có đánh giá chi tiết cho sản phẩm!</p>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-center mt-3 gap-2">
                                            <h4 class="mb-0">
                                                {{ number_format((int) ($dataPrd->sale_percent > 0 ? $dataPrd->price_default * (1 - $dataPrd->sale_percent / 100) : ($dataPrd->price_sale > 0 ? $dataPrd->price_sale : $dataPrd->price_default)), 0, ',', '.') }}
                                                (VND)
                                            </h4>
                                            @if ($dataPrd->sale_percent > 0 || $dataPrd->price_sale > 0)
                                                <h5 class="mb-0 text-decoration-line-through text-light-3">
                                                    {{ number_format((int) $dataPrd->price_default, 0, ',', '.') }}
                                                </h5>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <h6>
                                                {!! $dataPrd->quantity > 0 ? "Số lượng tồn kho: $dataPrd->quantity" : 'Sản phẩm có sẵn' !!}
                                            </h6>
                                        </div>
                                        <div class="row row-cols-auto align-items-center mt-3">
                                            <div class="col">
                                                <label class="form-label">Quantity:</label>
                                                <input class="form-control form-input-sm" type="number" min="0"
                                                    value="1" max="{{ $dataPrd->quantity }}" name="quantity">
                                            </div>
                                            @if (count($dataPrd->variants) > 0)
                                                <div class="col">
                                                    <label class="form-label">Size</label>
                                                    <select class="form-select form-select-sm" name="prd_size">
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->id }}">
                                                                {{ $size->sizeValue }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Colors</label>
                                                    <div class="color-indigators d-flex align-items-center gap-2">
                                                        @foreach ($colors as $color)
                                                            <input type="radio" name="color"
                                                                id="color-{{ $color->id }}" value="{{ $color->id }}"
                                                                hidden>
                                                            <label for="color-{{ $color->id }}"
                                                                class="color-indigator-item"
                                                                style="background-color: {{ $color->colorValue }};"></label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <!--end row-->
                                        <div class="gap-2 mt-3">
                                            <button type="submit" class="btn btn-dark btn-ecomm">
                                                <i class="bx bxs-cart-add"></i>Add to Cart
                                            </button>
                                        </div>
                                        <div class="gap-2 mt-3">
                                            <a href="javascript:;" class="btn btn-light btn-ecomm">
                                                <i class="bx bx-heart"></i>Add to Wishlist
                                            </a>
                                        </div>
                                        <hr />
                                        <div class="product-sharing">
                                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                                <div class="">
                                                    <a class="btn-social bg-twitter">
                                                        <i class='bx bxl-twitter'></i>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a class="btn-social bg-facebook">
                                                        <i class='bx bxl-facebook'></i>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a class="btn-social bg-linkedin">
                                                        <i class='bx bxl-linkedin'></i>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a class="btn-social bg-youtube">
                                                        <i class='bx bxl-youtube'></i>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a class="btn-social bg-pinterest">
                                                        <i class='bx bxl-pinterest'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </section>
            <!--end product detail-->
            <!--start product more info-->
            <section class="py-4">
                <div class="container">
                    <div class="product-more-info">
                        <ul class="nav nav-tabs mb-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discription">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title text-uppercase fw-500">Description</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#more-info">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title text-uppercase fw-500">More Info</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tags">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title text-uppercase fw-500">Tags</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#reviews">
                                    <div class="d-flex align-items-center">
                                        @if ($totalReviews > 0)
                                            <div class="tab-title text-uppercase fw-500">({{ $totalReviews }}) Reviews
                                            </div>
                                        @else
                                            <div class="tab-title text-uppercase fw-500">Reviews</div>
                                        @endif
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3">
                            <div class="tab-pane fade" id="discription">{!! $dataPrd->description !!}</div>
                            <div class="tab-pane fade" id="more-info">
                                {!! $dataPrd->material !!}
                                <br>
                                {!! $dataPrd->user_manual !!}
                            </div>
                            <div class="tab-pane fade" id="tags">
                                <div class="tags-box d-flex flex-wrap gap-2">
                                    @foreach ($dataPrd->tags as $tags)
                                        <a href="javascript:;"
                                            class="btn btn-ecomm btn-outline-dark">{{ $tags->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="reviews">
                                <div class="row">
                                    <div class="col col-lg-8">
                                        <div class="product-review">
                                            @if ($totalReviews > 0)
                                                <h5 class="mb-4">{{ $totalReviews }} Reviews For The Product</h5>
                                            @else
                                                <h5 class="mb-4">Reviews For The Product</h5>
                                            @endif
                                            @if (count($dataPrd->reviews) > 0)
                                                @foreach ($dataPrd->reviews as $review)
                                                    <div class="review-list">
                                                        <div class="d-flex align-items-start">
                                                            <div class="review-content ms-3">
                                                                <div class="rates cursor-pointer fs-6">
                                                                    @for ($i = 0; $i < $review->rating; $i++)
                                                                        <i class="bx bxs-star text-warning"></i>
                                                                    @endfor
                                                                </div>
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <h6 class="mb-0">{{ $review->user_name }}</h6>
                                                                    <p class="mb-0 ms-auto">{{ $review->review_date }}</p>
                                                                </div>
                                                                <p>{{ $review->comment }}</p>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <form action="{{ route('shop.reviews') }}" class="col col-lg-4" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $dataPrd->id }}">
                                        <div class="add-review border">
                                            <div class="form-body p-3">
                                                <h4 class="mb-4">Write a Review</h4>
                                                <div class="mb-3">
                                                    <label class="form-label">Rating</label> <br>
                                                    <div class="star-rating">
                                                        <input type="radio" id="5-stars" name="rating"
                                                            value="5" />
                                                        <label for="5-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="4-stars" name="rating"
                                                            value="4" />
                                                        <label for="4-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="3-stars" name="rating"
                                                            value="3" />
                                                        <label for="3-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="2-stars" name="rating"
                                                            value="2" />
                                                        <label for="2-stars" class="star">&#9733;</label>
                                                        <input type="radio" id="1-star" name="rating"
                                                            value="1" />
                                                        <label for="1-star" class="star">&#9733;</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Example textarea</label>
                                                    <textarea class="form-control rounded-0" rows="3" name="comment"></textarea>
                                                </div>
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-dark btn-ecomm">
                                                        Submit a Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end product more info-->
            <!--start similar products-->
            <section class="py-4">
                <div class="container">
                    <div class="separator pb-4">
                        <div class="line"></div>
                        <h5 class="mb-0 fw-bold separator-title">Similar Products</h5>
                        <div class="line"></div>
                    </div>
                    <div class="product-grid">
                        <div class="similar-products owl-carousel owl-theme position-relative">
                            @foreach ($prdSimilar as $similar)
                                <div class="item">
                                    <div class="card">
                                        <div class="position-relative overflow-hidden">
                                            <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                                <a href="{{ route('shop.detail', $similar->slug) }}">Product Detail</a>
                                            </div>
                                            <a href="{{ route('shop.detail', $similar->slug) }}">
                                                <img src="{{ \Storage::url($similar->image_thumbnail) }}"
                                                    class="img-fluid" alt="...">
                                            </a>
                                        </div>
                                        <div class="card-body px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <h6 class="mb-0 fw-bold product-short-title">{{ $similar->name }}
                                                        {!! $similar->sale_percent > 0 ? "(-$similar->sale_percent%)" : '' !!}</h6>
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
                                                @if ($similar->sale_percent > 0 || $similar->price_sale > 0)
                                                    <div
                                                        class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                        {{ number_format((int) $similar->price_default, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                                <div class="h6 fw-bold">
                                                    {{ number_format((int) ($similar->sale_percent > 0 ? $similar->price_default * (1 - $similar->sale_percent / 100) : ($similar->price_sale > 0 ? $similar->price_sale : $similar->price_default)), 0, ',', '.') }}
                                                    (VND)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <!--end similar products-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('js-setting')
    <script src="{{ asset('theme/client/js/product-details.js') }}"></script>
@endsection
