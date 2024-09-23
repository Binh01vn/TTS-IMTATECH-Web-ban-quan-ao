<!--start New Arrivals-->
<section class="py-4">
    <div class="container">
        <div class="separator pb-4">
            <div class="line"></div>
            <h5 class="mb-0 fw-bold separator-title">New Arrivals</h5>
            <div class="line"></div>
        </div>
        <div class="product-grid">
            <div class="new-arrivals owl-carousel owl-theme position-relative">
                @foreach ($dataProductNew as $prdNew)
                    <div class="item">
                        <div class="card">
                            <div class="position-relative overflow-hidden">
                                <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                    <a href="{{ route('shop.detail', $prdNew->slug) }}">Product Detail</a>
                                </div>
                                <a href="{{ route('shop.detail', $prdNew->slug) }}">
                                    <img src="{{ \Storage::url($prdNew->image_thumbnail) }}" class="img-fluid"
                                        alt="...">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div style="padding: 3px;">
                                        <h6 class="mb-0 fw-bold product-short-title">{{ $prdNew->name }}
                                            {!! $prdNew->sale_percent > 0 ? "(-$prdNew->sale_percent%)" : '' !!}
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
                                <div class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                    @if ($prdNew->sale_percent > 0 || $prdNew->price_sale > 0)
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                            {{ number_format((int) $prdNew->price_default, 0, ',', '.') }}
                                        </div>
                                    @endif
                                    <div class="h6 fw-bold">
                                        {{ number_format((int) ($prdNew->sale_percent > 0 ? $prdNew->price_default * (1 - $prdNew->sale_percent / 100) : ($prdNew->price_sale > 0 ? $prdNew->price_sale : $prdNew->price_default)), 0, ',', '.') }}
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
<!--end New Arrivals-->
@section('modal-product')
    <!-- Modal -->
    @foreach ($dataProductNew as $prdNew)
        <div class="modal fade" id="viewPrd{{ $prdNew->id }}">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-down">
                <div class="modal-content rounded-0 border-0">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                        <div class="row g-0">
                            <div class="col-12 col-lg-6">
                                <div class="image-zoom-section">
                                    <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
                                        <div class="item">
                                            <img src="{{ \Storage::url($prdNew->image_thumbnail) }}" class="img-fluid"
                                                alt=".....">
                                        </div>
                                        @foreach ($prdNew->galleries as $imageG)
                                            <div class="item">
                                                <img src="{{ \Storage::url($imageG->image) }}" class="img-fluid"
                                                    alt=".....">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                        <button class="owl-thumb-item">
                                            <img src="{{ \Storage::url($prdNew->image_thumbnail) }}" class=""
                                                alt=".....">
                                        </button>
                                        @foreach ($prdNew->galleries as $imageG)
                                            <button class="owl-thumb-item">
                                                <img src="{{ \Storage::url($imageG->image) }}" class=""
                                                    alt=".....">
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="product-info-section p-3">
                                    <h3 class="mt-3 mt-lg-0 mb-0">{{ $prdNew->name }}</h3>
                                    <div class="product-rating d-flex align-items-center mt-2">
                                        <div class="rates cursor-pointer font-13"> <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="ms-1">
                                            <p class="mb-0">(24 Ratings)</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3 gap-2">
                                        <h4 class="mb-0">
                                            {{ number_format((int) ($prdNew->sale_percent > 0 ? $prdNew->price_default * (1 - $prdNew->sale_percent / 100) : ($prdNew->price_sale > 0 ? $prdNew->price_sale : $prdNew->price_default)), 0, ',', '.') }}
                                            (VND)
                                        </h4>
                                        @if ($prdNew->sale_percent > 0 || $prdNew->price_sale > 0)
                                            <h5 class="mb-0 text-decoration-line-through text-light-3">
                                                {{ number_format((int) $prdNew->price_default, 0, ',', '.') }}
                                            </h5>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <h6>
                                            {!! $prdNew->quantity > 0 ? "Số lượng tồn kho: $prdNew->quantity" : 'Sản phẩm có sẵn' !!}
                                        </h6>
                                        <p class="mb-0">{!! $prdNew->description !!}</p>
                                    </div>
                                    <div class="row row-cols-auto align-items-center mt-3">
                                        <div class="col">
                                            <label class="form-label">Quantity:</label>
                                            <input class="form-control form-input-sm" type="number" min="0"
                                                max="{{ $prdNew->quantity }}" name="quantity">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Size</label>
                                            <select class="form-select form-select-sm">
                                                <option>S</option>
                                                <option>M</option>
                                                <option>L</option>
                                                <option>XS</option>
                                                <option>XL</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Colors</label>
                                            <div class="color-indigators d-flex align-items-center gap-2">
                                                <div class="color-indigator-item bg-primary"></div>
                                                <div class="color-indigator-item bg-danger"></div>
                                                <div class="color-indigator-item bg-success"></div>
                                                <div class="color-indigator-item bg-warning"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="javascript:;" class="btn btn-dark btn-ecomm"> <i
                                                class="bx bxs-cart-add"></i>Add to Cart</a> <a href="javascript:;"
                                            class="btn btn-light btn-ecomm"><i class="bx bx-heart"></i>Add to
                                            Wishlist</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!--end quick view product-->
@endsection

@section('js-setting')
    <script>
        function loadModalPRD(prd) {
            let urlProduct = `{{ route('modal') }}`;
            if (prd != '') {
                $.ajax({
                    url: urlProduct,
                    type: 'GET',
                    data: {
                        prdSlug: prd
                    },
                    success: function(response) {
                        console.log(response.image_thumbnail);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        }
    </script>
@endsection
