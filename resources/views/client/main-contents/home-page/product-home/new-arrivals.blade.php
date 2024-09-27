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
