@extends('layouts.client')
@section('title')
    {{ $data->name }}
@endsection
@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">{{ $data->name }}</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            <i class="bx bx-home-alt"></i> Trang chủ
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Cửa hàng</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm chi tiết</li>
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
                                                @php
                                                    $avt = $data->product_avatar;
                                                    if (!\Str::contains($avt, 'http')) {
                                                        $avt = \Storage::url($avt);
                                                    }
                                                @endphp
                                                <img src="{{ $avt }}" class="img-fluid" alt=".....">
                                            </div>
                                            @foreach ($data->galleries as $gallery)
                                                @php
                                                    $url = $gallery->path_images;
                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = \Storage::url($url);
                                                    }
                                                @endphp
                                                <div class="item">
                                                    <img src="{{ $url }}" class="img-fluid" alt=".....">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                            <button class="owl-thumb-item">
                                                <img src="{{ $avt }}" class="....." alt="">
                                            </button>
                                            @foreach ($data->galleries as $gallery)
                                                @php
                                                    $url = $gallery->path_images;
                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = \Storage::url($url);
                                                    }
                                                @endphp
                                                <button class="owl-thumb-item">
                                                    <img src="{{ $url }}" class="" alt=".....">
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="product-info-section p-3">
                                        <form action="" method="POST" class="prd-info-rq">
                                            @csrf
                                            <h3 class="mt-3 mt-lg-0 mb-0"> {{ $data->name }}</h3>
                                            <div class="product-rating d-flex align-items-center mt-2">
                                                <div class="rates cursor-pointer font-13"> <i
                                                        class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-light-4"></i>
                                                </div>
                                                <div class="ms-1">
                                                    <p class="mb-0">(24 Ratings)</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mt-3 gap-2 loadPrice">
                                                <h4 class="mb-0">
                                                    {{ number_format((int) ($data->discount_percent > 0 ? $data->price_default * (1 - $data->discount_percent / 100) : ($data->price_sale > 0 ? $data->price_sale : $data->price_default)), 0, ',', '.') }}
                                                    (VND)
                                                </h4>
                                                @if ($data->discount_percent > 0 || $data->price_sale > 0)
                                                    <h5 class="mb-0 text-decoration-line-through text-light-3">
                                                        {{ number_format((int) $data->price_default, 0, ',', '.') }}
                                                    </h5>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <h6>Mô tả :</h6>
                                                <p class="mb-0">{!! $data->description !!}</p>
                                            </div>
                                            <div class="mt-3 loadQuantity">
                                                <h6>
                                                    {{ $data->quantity > 0 ? "Số lượng tồn kho: $data->quantity" : 'Sản phẩm có sẵn' }}
                                                </h6>
                                            </div>
                                            <dl class="row mt-3">
                                                <dt class="col-sm-3">MÃ SẢN PHẨM:</dt>
                                                <dd class="col-sm-9">{{ $data->sku }}</dd>
                                                <dt class="col-sm-3">THUỘC DANH MỤC:</dt>
                                                <dd class="col-sm-9">{{ $data->category['name'] }}</dd>
                                            </dl>
                                            <div class="row row-cols-auto align-items-center mt-3">
                                                <div class="col">
                                                    <label class="form-label">Số lượng</label>
                                                    <input class="form-control form-input-sm" type="number" name="quantity"
                                                        min="0" max="10">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Kích thước</label>
                                                    <select class="form-select form-select-sm" name="idSize"
                                                        id="idSize">
                                                        @foreach ($sizes as $item)
                                                            <option value="{{ $item->id }}">{{ $item->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Màu sắc</label>
                                                    <div class="color-indigators d-flex align-items-center gap-2">
                                                        @foreach ($colors as $item)
                                                            <input type="radio" name="idColor"
                                                                id="color-{{ $item->id }}" value="{{ $item->id }}"
                                                                hidden>
                                                            <label for="color-{{ $item->id }}"
                                                                class="color-indigator-item"
                                                                style="background-color: {{ $item->value }};"></label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end row-->
                                            <div class="d-flex gap-2 mt-3">
                                                <a href="javascript:;" class="btn btn-dark btn-ecomm">
                                                    <i class="bx bxs-cart-add"></i>
                                                    Thêm vào giỏ hàng
                                                </a>
                                                <a href="javascript:;" class="btn btn-light btn-ecomm">
                                                    <i class="bx bx-heart"></i>
                                                    Thêm vào yêu thích
                                                </a>
                                            </div>
                                        </form>
                                    </div>
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
                                        <div class="tab-title text-uppercase fw-500">Mô tả</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#more-info">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title text-uppercase fw-500">Các thông tin khác</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tags">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title text-uppercase fw-500">Thẻ</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#reviews">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title text-uppercase fw-500">(3) Đánh giá</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3">
                            <div class="tab-pane fade" id="discription">{!! $data->description !!}</div>
                            <div class="tab-pane fade" id="more-info">
                                {!! $data->material !!}
                                {!! $data->user_manual !!}
                            </div>
                            <div class="tab-pane fade" id="tags">
                                <div class="tags-box d-flex flex-wrap gap-2">
                                    @foreach ($data->tags as $item)
                                        <a href="javascript:;"
                                            class="btn btn-ecomm btn-outline-dark">{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="reviews">
                                <div class="row">
                                    <div class="col col-lg-7">
                                        <div class="product-review">
                                            <h5 class="mb-4">3 Đánh giá về sản phẩm</h5>
                                            <div class="review-list">
                                                <div class="d-flex align-items-start">
                                                    <div class="review-content ms-3">
                                                        <div class="rates cursor-pointer fs-6">
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <h6 class="mb-0">James Caviness</h6>
                                                            <p class="mb-0 ms-auto">February 16, 2021</p>
                                                        </div>
                                                        <p>Nesciunt tofu stumptown aliqua, retro synth master cleanse.
                                                            Mustache cliche tempor, williamsburg carles vegan helvetica.
                                                            Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby
                                                            sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                                                            placeat salvia cillum iphone. Seitan aliquip quis cardigan</p>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-5">
                                        <form action="{{ route('shop.review_sp') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $data->id }}">
                                            <div class="add-review border">
                                                <div class="form-body p-3">
                                                    <h4 class="mb-4">Cho chúng tôi biến đánh giá của bạn</h4>
                                                    <div class="mb-3">
                                                        <label class="form-label">Xếp hạng</label> <br>
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
                                                        <label class="form-label">Đánh giá</label>
                                                        <textarea class="form-control rounded-0" rows="6" name="comment"></textarea>
                                                    </div>
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-dark btn-ecomm">
                                                            Gửi đánh giá
                                                        </button>
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
                </div>
            </section>
            <!--end product more info-->
            <!--start similar products-->
            <section class="py-4">
                <div class="container">
                    <div class="separator pb-4">
                        <div class="line"></div>
                        <h5 class="mb-0 fw-bold separator-title">Sản phẩm tương tự</h5>
                        <div class="line"></div>
                    </div>
                    <div class="product-grid">
                        <div class="similar-products owl-carousel owl-theme position-relative">
                            @foreach ($similars as $item)
                                <div class="item">
                                    <div class="card">
                                        <div class="position-relative overflow-hidden">
                                            <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                                <a href="{{ route('shop.detail_sp', $item->slug) }}">Product Detail</a>
                                            </div>
                                            <a href="{{ route('shop.detail_sp', $item->slug) }}">
                                                @php
                                                    $url = $item->product_avatar;
                                                    if (!\Str::contains($url, 'http')) {
                                                        $url = \Storage::url($url);
                                                    }
                                                @endphp
                                                <img src="{{ $url }}" class="img-fluid" alt=".....">
                                            </a>
                                        </div>
                                        <div class="card-body px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <h6 class="mb-0 fw-bold product-short-title">{{ $item->name }}
                                                        {{ $item->discount_percent > 0 ? "(-$item->discount_percent%)" : '' }}
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
                                                @if ($item->discount_percent > 0 || $item->price_sale > 0)
                                                    <div
                                                        class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                        {{ number_format((int) $item->price_default, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                                <div class="h6 fw-bold">
                                                    {{ number_format((int) ($item->discount_percent > 0 ? $item->price_default * (1 - $item->discount_percent / 100) : ($item->price_sale > 0 ? $item->price_sale : $item->price_default)), 0, ',', '.') }}
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
@section('js-libs')
    <script src="{{ asset('theme/client/js/product-details.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        $(document).ready(function() {
            // Đính kèm CSRF token cho tất cả các yêu cầu Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Hàm lấy giá trị
            function handleSelectionChange() {
                var selectedSize = $('#idSize').val();
                var selectedColor = $('input[name="idColor"]:checked').val();
                var selectedPrdID = {{ $data->id }};

                if (selectedColor > 0 && selectedSize > 0 && selectedPrdID > 0) {
                    sendAjaxRequest(selectedPrdID, selectedSize, selectedColor);
                }
            }

            // Thay đổi sự kiện khi chọn kích thước hoặc màu sắc
            $('#idSize, input[name="idColor"]').change(handleSelectionChange);

            // Hàm gửi Ajax
            function sendAjaxRequest(selectedPrdID, selectedSize, selectedColor) {
                $.ajax({
                    url: '{{ route('ajax.rendPrdV') }}',
                    type: 'POST',
                    data: {
                        prd_id: selectedPrdID,
                        idSize: selectedSize,
                        idColor: selectedColor
                    },
                    success: function(response) {
                        updateHiddenInput('idVariant', response.id);
                        updateHiddenInput('colorValue', response.color_value);
                        updateHiddenInput('sizeValue', response.size_value);

                        var formatPrice = price => price.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                            ".");
                        var price_default = formatPrice(response.price_default != null ? response
                            .price_default : {{ $data->price_default }});
                        var price_sale = formatPrice(response.price_sale != null ? response.price_sale :
                            {{ $data->price_sale > 0 ? $data->price_sale : 0 }});
                        var quantity = response.quantity != null ? response.quantity :
                            {{ $data->quantity > 0 ? $data->quantity : 0 }};
                        $('div.d-flex.align-items-center.mt-3.gap-2.loadPrice').empty().append(
                            price_sale > 0 ?
                            `<h4 class="mb-0">${price_sale} (VNĐ)</h4><h5 class="mb-0 text-decoration-line-through text-light-3">${price_default}</h5>` :
                            `<h4 class="mb-0">${price_default} (VNĐ)</h4>`
                        );

                        $('div.mt-3.loadQuantity').empty().append(
                            `<h6>Số lượng tồn kho: ${quantity}</h6>`);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Vui lòng chọn giá trị hợp lệ!');
                    }
                });
            }

            // Hàm cập nhật hoặc thêm thẻ input
            function updateHiddenInput(name, value) {
                var input = document.querySelector(`input[type="hidden"][name="${name}"]`);
                if (input) {
                    input.value = value; // Nếu input đã tồn tại, cập nhật giá trị
                } else {
                    input = document.createElement('input'); // Tạo thẻ input mới
                    input.type = 'hidden';
                    input.name = name;
                    input.value = value;
                    document.querySelector('form.prd-info-rq').appendChild(input); // Thêm vào form
                }
            }
            // Xử lý khi gửi form
            $('form.prd-info-rq').on('submit', function(event) {
                var idPRD = {{ $data->id }};
                var inputIDPRD = $('<input>', {
                    type: 'hidden',
                    name: 'idProduct',
                    value: idPRD
                });
                $(this).append(inputSlug, inputIDPRD);
            });
        });
    </script>
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
