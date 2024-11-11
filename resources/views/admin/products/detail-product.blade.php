@extends('layouts.admin')
@section('title')
    Chi tiết sản phẩm
@endsection
@section('contents')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="product-slider" id="galleryTop">
                        <div class="swiper theme-slider position-lg-absolute all-0"
                            data-swiper='{"autoHeight":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"thumb":{"spaceBetween":5,"slidesPerView":5,"loop":true,"freeMode":true,"grabCursor":true,"loopedSlides":5,"centeredSlides":true,"slideToClickedSlide":true,"watchSlidesVisibility":true,"watchSlidesProgress":true,"parent":"#galleryTop"},"slideToClickedSlide":true}'>
                            <div class="swiper-wrapper h-100">
                                <div class="swiper-slide h-100">
                                    @php
                                        $url = $data->product_avatar;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = \Storage::url($url);
                                        }
                                    @endphp
                                    <img class="rounded-1 object-fit-cover h-100 w-100" src="{{ $url }}"
                                        alt="" />
                                </div>
                                @if (count($data->galleries) > 0)
                                    @foreach ($data->galleries as $item)
                                        <div class="swiper-slide h-100">
                                            @php
                                                $url = $item->path_images;
                                                if (!\Str::contains($url, 'http')) {
                                                    $url = \Storage::url($url);
                                                }
                                            @endphp
                                            <img class="rounded-1 object-fit-cover h-100 w-100" src="{{ $url }}"
                                                alt="" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="swiper-nav">
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="height: 450px">
                    <h5>Tên: {{ $data->name }}</h5>
                    <div class="fs-11 mb-3 d-inline-block text-decoration-none">
                        Mã sản phẩm:
                        <span class="ms-1 text-600">{{ $data->sku }}</span>
                    </div>
                    <p class="fs-10">
                        <strong>Mô tả:</strong>
                        {!! $data->description !!}
                    </p>
                    <h4 class="d-flex align-items-center">
                        Giá:
                        <span class="text-warning me-2" style="padding-left: 3px;">
                            {{ number_format(
                                (int) ($data->discount_percent > 0
                                    ? $data->price_default * (1 - $data->discount_percent / 100)
                                    : ($data->price_sale > 0
                                        ? $data->price_sale
                                        : $data->price_default)),
                                0,
                                ',',
                                '.',
                            ) }}
                            (VND)
                        </span>
                        @if ($data->discount_percent > 0 || $data->price_sale > 0)
                            <span class="me-1 fs-10 text-500">
                                <del class="me-1">
                                    {{ number_format((int) $data->price_default, 0, ',', '.') }}
                                </del>
                            </span>
                        @endif
                    </h4>
                    <p class="fs-10">Trạng thái: {!! $data->status == 1
                        ? '<strong class="text-success">Xuất bản</strong>'
                        : '<strong class="text-danger">Chưa xuất bản</strong>' !!}</p>
                    <p class="fs-10 mb-3">Tags:
                        @foreach ($data->tags as $item)
                            <a class="ms-2 badge bg-info" href="#!">{{ $item->name }}</a>
                        @endforeach
                    </p>
                    <hr>
                    <a href="{{ route('admin.products.edit_sp', $data->slug) }}" class="btn btn-warning">Cập nhật sản
                        phẩm</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mt-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="description-tab" data-bs-toggle="tab"
                                    href="#tab-description" role="tab" aria-controls="tab-description"
                                    aria-selected="true">Mô tả sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 px-md-3" id="specifications-tab" data-bs-toggle="tab"
                                    href="#tab-specifications" role="tab" aria-controls="tab-specifications"
                                    aria-selected="false">Chất liệu sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 px-md-3" id="variants-tab" data-bs-toggle="tab" href="#tab-variants"
                                    role="tab" aria-controls="tab-variants" aria-selected="false">Biến thể sản phẩm</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <div class="mt-3">
                                    {!! $data->description !!}
                                </div>
                                <hr>
                                <div class="mt-3">
                                    {!! $data->user_manual !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-specifications" role="tabpanel"
                                aria-labelledby="specifications-tab">
                                <div class="mt-3">
                                    {!! $data->material !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-variants" role="tabpanel" aria-labelledby="variants-tab">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Biến thể</th>
                                                <th>Giá mặc định (VNĐ)</th>
                                                <th>Giá khuyến mại (VNĐ)</th>
                                                <th>Ngày bắt đầu (KM)</th>
                                                <th>Ngày bắt thúc (KM)</th>
                                                <th>Số lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->variants as $itemV)
                                                <tr>
                                                    <td>{{ $itemV->id }}</td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <strong>Màu sắc:</strong>
                                                            <span class="badge bg"
                                                                style="background-color: {{ $itemV->color['value'] }};">{{ $itemV->color['value'] }}</span>
                                                        </div>
                                                        <strong>Kích thước: {{ $itemV->size['value'] }}</strong>
                                                    </td>
                                                    <td>
                                                        {{ number_format((int) $itemV->price_default, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        {{ number_format((int) $itemV->price_sale, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        {!! $itemV->start_date != null
                                                            ? $itemV->start_date
                                                            : '<strong class="text-warning">Không thiết lập cho mục này!</strong>' !!}
                                                    </td>
                                                    <td>
                                                        {!! $itemV->end_date != null
                                                            ? $itemV->end_date
                                                            : '<strong class="text-warning">Không thiết lập cho mục này!</strong>' !!}
                                                    </td>
                                                    <td>
                                                        {!! $itemV->quantity > 0
                                                            ? $itemV->quantity
                                                            : '<strong class="text-warning">Không có số lượng cụ thể cho sản phẩm!</strong>' !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/rater-js/index.js') }}"></script>
@endsection
