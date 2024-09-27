@extends('layouts.master')

@section('title')
    List Product
@endsection
@section('contents')
    <div class="card mb-3" id="tableExample3"
        data-list='{"valueNames":["id","image","name","price","view","quantity","status"],"page":10,"pagination":true}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    @if (session('success'))
                        <h5 class="fs-9 mb-0 text-success py-2 py-xl-0">{{ session('success') }}</h5>
                    @else
                        @if (session('error'))
                            <h5 class="fs-9 mb-0 text-danger py-2 py-xl-0">{{ session('error') }}</h5>
                        @else
                            <a href="{{ route('admin.products.createPrd') }}" class="btn btn-primary">Add new</a>
                        @endif
                    @endif
                </div>
                <div class="col-4 col-sm-4 d-flex pe-0">
                    <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..."
                        aria-label="search" />
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="falcon-data-table">
                <table class="table table-sm mb-0 data-table fs-10">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="id">ID</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="image">Image Thumbnail
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="name">Name</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="price">Price Regular
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="view">Views</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="quantity">Quantity
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap">Tags</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="status">Status</th>
                            <th class="text-900 no-sort pe-1 align-middle data-table-row-action">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-purchase-body">
                        @foreach ($dataProduct as $itemPrd)
                            <tr class="btn-reveal-trigger">
                                <td class="align-middle id">#-{{ $itemPrd->id }}</td>
                                <td class="align-middle white-space-nowrap image">
                                    <img src="{{ \Storage::url($itemPrd->image_thumbnail) }}" alt="Error!" width="70px">
                                </td>
                                <td class="align-middle white-space-nowrap fw-semi-bold name">
                                    <a href="">{{ $itemPrd->name }}</a>
                                </td>
                                <td class="align-middle text-start price">
                                    {{ number_format((int) $itemPrd->price_default, 0, ',', '.') }} (VNĐ)
                                </td>
                                <td class="align-middle text-start view">{{ $itemPrd->views }}</td>
                                <td class="align-middle text-start quantity">{{ $itemPrd->quantity }}</td>
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
                                            @foreach ($itemPrd->tags as $tag)
                                                <p class="dropdown-item">
                                                    <span class="badge bg-info">{{ $tag->name }}</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle white-space-nowrap status">
                                    {!! $itemPrd->is_active == 1
                                        ? '<span class="badge rounded-pill badge-subtle-success">Active <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>'
                                        : '<span class="badge rounded-pill badge-subtle-danger">Unactive <span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>' !!}
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
                                            <a class="dropdown-item text-center" href="">
                                                <span class="btn btn-info">View</span>
                                            </a>
                                            <a class="dropdown-item text-center"
                                                href="{{ route('admin.products.editProduct', $itemPrd->slug) }}">
                                                <span class="btn btn-warning">Edit</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="" method="post" style="text-align: center;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Có chắc chắn muốn xóa không?')"
                                                    type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-12">
                    {{ $dataProduct->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
