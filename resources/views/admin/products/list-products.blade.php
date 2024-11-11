@extends('layouts.admin')
@section('title')
    Danh sách sản phẩm
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
                            <h5 class="mb-2 mb-md-0">Danh sách sản phẩm</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3" id="tableExample3"
        data-list='{"valueNames":["id","image","name","price","view","quantity","status"]}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <a href="{{ route('admin.products.show_form') }}" class="btn btn-primary">Thêm sản phẩm mới</a>
                </div>
                <div class="col-4 col-sm-4 d-flex pe-0">
                    <input class="form-control form-control-sm shadow-none search" type="search"
                        placeholder="Tìm kiếm tại đây..." aria-label="search" />
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="falcon-data-table">
                <table class="table table-sm mb-0 data-table fs-10">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="id">#</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="image">
                                Ảnh đại diện
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="name">Tên</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="price">
                                Giá mặc định (VNĐ)
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="view">Lượt xem</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="quantity">
                                Số lượng
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap">Thẻ</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="status">Trạng thái
                            </th>
                            <th class="text-900 no-sort pe-1 align-middle data-table-row-action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-purchase-body">
                        @php $index = 1; @endphp
                        @foreach ($data as $item)
                            <tr class="btn-reveal-trigger">
                                <td class="align-middle id">{{ $index }}</td>
                                <td class="align-middle white-space-nowrap image">
                                    @php
                                        $url = $item->product_avatar;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = \Storage::url($url);
                                        }
                                    @endphp
                                    <img src="{{ $url }}" alt="Error!" width="100px">
                                </td>
                                <td class="align-middle white-space-nowrap fw-semi-bold name">
                                    <a href="{{ route('admin.products.detail_sp', $item->slug) }}">{{ $item->name }}</a>
                                    <br>
                                    <h6>{{ $item->slug }}</h6>
                                </td>
                                <td class="align-middle text-start price">
                                    {{ number_format((int) $item->price_default, 0, ',', '.') }}
                                </td>
                                <td class="align-middle text-start view">{{ $item->views }}</td>
                                <td class="align-middle text-start quantity">{{ $item->quantity }}</td>
                                <td class="align-middle white-space-nowrap">
                                    <div class="dropstart font-sans-serif position-static d-inline-block">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end"
                                            type="button" id="dropdown-number-pagination-table-item-1"
                                            data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                            aria-expanded="false" data-bs-reference="parent">
                                            <span class="fas fa-tag fs-10"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                            aria-labelledby="dropdown-number-pagination-table-item-1">
                                            @foreach ($item->tags as $tag)
                                                <p class="dropdown-item">
                                                    <span class="badge bg-info">{{ $tag->name }}</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle white-space-nowrap status">
                                    {!! $item->status == 1
                                        ? '<span class="badge rounded-pill badge-subtle-success">Xuất bản<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>'
                                        : '<span class="badge rounded-pill badge-subtle-danger">Chưa xuất bản<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>' !!}
                                </td>
                                <td class="align-middle white-space-nowrap">
                                    <div class="dropstart font-sans-serif position-static d-inline-block">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end"
                                            type="button" id="dropdown-number-pagination-table-item-0"
                                            data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                            aria-expanded="false" data-bs-reference="parent">
                                            <span class="fas fa-ellipsis-h fs-10"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                            aria-labelledby="dropdown-number-pagination-table-item-0">
                                            <a class="dropdown-item text-center"
                                                href="{{ route('admin.products.detail_sp', $item->slug) }}">
                                                <span class="btn btn-info">Chi tiết</span>
                                            </a>
                                            <a class="dropdown-item text-center"
                                                href="{{ route('admin.products.edit_sp', $item->slug) }}">
                                                <span class="btn btn-warning">Cập nhật</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admin.products.xoa_sp', $item) }}" method="post"
                                                style="text-align: center;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Có chắc chắn muốn xóa không?')"
                                                    type="submit">Xóa sản phẩm</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php $index++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- PAGINATE PAGES --}}
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-12">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
