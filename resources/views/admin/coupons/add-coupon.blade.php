@extends('layouts.admin')
@section('title')
    Thêm mới mã khuyến mại
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md">
                    @if (session()->has('error'))
                        <h5 class="mb-2 mb-md-0 text-danger">{{ session('error') }}</h5>
                    @else
                        @if (session()->has('success'))
                            <h5 class="mb-2 mb-md-0 text-success">{{ session('success') }}</h5>
                        @else
                            <h5 class="mb-2 mb-md-0">Thêm mã khuyến mại</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.coupons.store_mkm') }}" method="post">
        @csrf
        <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thông tin cơ bản</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="name">Tên mã khuyến mại:</label>
                                <input class="form-control" id="name" type="text" name="name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="code">Mã khuyến mại:</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" id="code" name="code"
                                        value="{{ old('code') }}" />
                                    <button type="button" class="input-group-text btn btn-info" onclick="generateSKU()">Tạo
                                        mã tự động</button>
                                </div>
                                @error('code')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="description">Mô tả:</label>
                                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="quantity">Số lượng mã:</label>
                                <input class="form-control" id="quantity" type="number" name="quantity"
                                    value="{{ old('quantity') }}" />
                                @error('quantity')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thời hạn sử dụng</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-lg-6 mb-3 ps-lg-2">
                                <label class="form-label" for="start_date">Ngày bắt đầu:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ old('start_date') }}">
                                @error('start_date')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3 ps-lg-2">
                                <label class="form-label" for="end_date">Ngày kết thúc:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ old('end_date') }}">
                                @error('end_date')
                                    <label class="form-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ps-lg-2">
                <div class="sticky-sidebar">
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Giá trị - Kiểu khuyến mại</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="discount_type">Kiểu giảm giá:</label>
                                    <select class="form-select" id="discount_type" name="discount_type">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($type_discount as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('discount_type')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="discount_amount">Giá trị mã khuyến mại:</label>
                                    <input type="number" name="discount_amount" id="discount_amount" class="form-control"
                                        value="{{ old('discount_amount') }}">
                                    @error('discount_amount')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Điều kiện sử dụng - Trạng thái</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="minimum_spend">Chi tiêu tối thiểu:</label>
                                    <input type="number" name="minimum_spend" id="minimum_spend" class="form-control"
                                        value="{{ old('minimum_spend') }}">
                                    @error('minimum_spend')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="maximum_spend">Chi tiêu tối đa:</label>
                                    <input type="number" name="maximum_spend" id="maximum_spend" class="form-control"
                                        value="{{ old('maximum_spend') }}">
                                    @error('maximum_spend')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="status_coupon" type="checkbox"
                                            name="status_coupon" value="1" {!! old('status_coupon') == 1 ? 'checked' : '' !!} />
                                        <label class="form-check-label" for="status_coupon">Hoạt động</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Bạn đã hoàn thành nhập thông tin cho mã khuyến mại?</h5>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" role="button" id="submit-button">
                            Tạo mới
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js-setting')
    <script>
        function generateSKU() {
            const lettersPart = Math.random().toString(36).substr(2, 6).toUpperCase();
            const numbersPart = Math.floor(100000 + Math.random() * 900000);
            const sku = lettersPart + '-' + numbersPart;
            document.getElementById('code').value = sku;
        }
    </script>
@endsection
