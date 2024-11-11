<section class="py-4">
    <div class="container">
        <div class="separator pb-4">
            <div class="line"></div>
            <h5 class="mb-0 fw-bold separator-title">SẢN PHẨM NỔI BẬT</h5>
            <div class="line"></div>
        </div>
        <div class="product-grid">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-3 g-sm-4">
                @foreach ($products as $item)
                    <div class="col">
                        <div class="card">
                            <div class="position-relative overflow-hidden">
                                <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                    <a href="{{ route('shop.detail_sp', $item->slug) }}">
                                        Xem chi tiết
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    @php
                                        $url = $item->product_avatar;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = \Storage::url($url);
                                        }
                                    @endphp
                                    <img src="{{ $url }}" class="img-fluid" alt="...">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div style="padding: 3px;">
                                        <p class="mb-1 product-short-name">{{ $item->category['name'] }}</p>
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
                                <div class="product-price mt-2">
                                    @if ($item->discount_percent > 0 || $item->price_sale > 0)
                                        <div class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
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
