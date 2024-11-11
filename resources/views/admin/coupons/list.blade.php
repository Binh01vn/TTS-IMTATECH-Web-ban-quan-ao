@extends('layouts.admin')
@section('title')
    Danh sách mã giảm giá
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
                            <h5 class="mb-2 mb-md-0">Danh sách mã giảm giá</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3" id="tableExample3" data-list='{"valueNames":["id","name","code","price","type","quantity"]}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <a href="{{ route('admin.coupons.add_mkm') }}" class="btn btn-primary">Thêm mã khuyến mại</a>
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
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="name">
                                Tên mã khuyến mại
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap">
                                Mã khuyến mại
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="price">
                                Giá trị giảm giá (VNĐ) hoặc (%)
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="type">
                                Kiểu giảm giá
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="quantity">
                                Số lượng
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="code">
                                Trạng thái
                            </th>
                            <th class="text-900 no-sort pe-1 align-middle data-table-row-action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-purchase-body">
                        @php $index = 1; @endphp
                        @foreach ($data as $item)
                            <tr class="btn-reveal-trigger">
                                <td class="align-middle id">{{ $index }}</td>
                                <td class="align-middle white-space-nowrap name">
                                    {{ $item->name }}
                                </td>
                                <td class="align-middle white-space-nowrap fw-semi-bold code">
                                    {{ $item->code }}
                                </td>
                                <td class="align-middle text-start price">
                                    {{ number_format((int) $item->discount_amount, 0, ',', '.') }}
                                </td>
                                <td class="align-middle text-start type">{{ $item->discount_type }}</td>
                                <td class="align-middle text-start quantity">{{ $item->quantity }}</td>
                                <td class="align-middle white-space-nowrap fw-semi-bold code">
                                    {{-- {{ $item->code }} --}}
                                    {!! $item->status_coupon == 1
                                        ? '<span class="badge rounded-pill badge-subtle-success">Hoạt động<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>'
                                        : '<span class="badge rounded-pill badge-subtle-danger">Không hoạt động<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>' !!}
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
                                                href="{{ route('admin.coupons.detai_mkm', $item->id) }}">
                                                <span class="btn btn-info">Chi tiết</span>
                                            </a>
                                            <a class="dropdown-item text-center"
                                                href="{{ route('admin.coupons.edit_mkm', $item->id) }}">
                                                <span class="btn btn-warning">Cập nhật</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admin.coupons.delete_mkm', $item) }}" method="post"
                                                style="text-align: center;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Có chắc chắn muốn xóa không? Nếu xóa thì tất cả các dữ liệu liên quan sẽ bị theo!')"
                                                    type="submit">Xóa mã</button>
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
