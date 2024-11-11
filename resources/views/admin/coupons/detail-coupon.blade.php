@extends('layouts.admin')
@section('title')
    Chi tiết mã khuyến mại
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md d-flex justify-content-between align-items-center">
                    <h5 class="mb-2 mb-md-0">Mã khuyến mại: {{ $data->name }}</h5>
                    <a href="{{ route('admin.coupons.edit_mkm', $data->id) }}" class="btn btn-warning">Cập nhật</a>
                </div>
            </div>
        </div>
    </div>
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
                            <div class="form-control">{{ $data->name }}</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="code">Mã khuyến mại:</label>
                            <div class="form-control">{{ $data->code }}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="description">Mô tả:</label>
                            <div class="form-control" style="height: 100px;">
                                {!! $data->description !!}
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="quantity">Số lượng mã:</label>
                            <div class="form-control">{{ $data->quantity }}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="quantity">Số lượng đã nhận:</label>
                            <div class="form-control">{{ $data->quantity_received }}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="quantity">Số lượng đã sử dụng:</label>
                            <div class="form-control">{{ $data->quantity_used }}</div>
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
                            <div class="form-control">{{ $data->start_date }}</div>
                        </div>
                        <div class="col-lg-6 mb-3 ps-lg-2">
                            <label class="form-label" for="end_date">Ngày kết thúc:</label>
                            <div class="form-control">{{ $data->end_date }}</div>
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
                                <div class="form-control">{{ $data->discount_type }}</div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="discount_amount">Giá trị mã khuyến mại:</label>
                                <div class="form-control">{{ $data->discount_amount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Điều kiện sử dụng</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="minimum_spend">Chi tiêu tối thiểu:</label>
                                <div class="form-control">{{ $data->minimum_spend }}</div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="maximum_spend">Chi tiêu tối đa:</label>
                                <div class="form-control">{{ $data->maximum_spend }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
