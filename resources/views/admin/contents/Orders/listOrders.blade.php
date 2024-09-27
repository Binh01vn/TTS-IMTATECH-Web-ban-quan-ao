@extends('layouts.master')

@section('title')
    List Orders
@endsection

@section('contents')
    <form action="{{ route('admin.orders.bulkActions') }}" method="POST" class="card mb-3" id="ordersTable"
        data-list='{"valueNames":["order","date","address","status","amount"],"page":10,"pagination":true}'>
        @csrf
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    @if (session('success'))
                        <h5 class="fs-9 mb-0 text-success py-2 py-xl-0">{{ session('success') }}</h5>
                    @else
                        @if (session('error'))
                            <h5 class="fs-9 mb-0 text-danger py-2 py-xl-0">{{ session('error') }}</h5>
                        @else
                            <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0">Orders</h5>
                        @endif
                    @endif
                </div>
                <div class="col-8 col-sm-auto ms-auto text-end ps-0">
                    <div class="d-none" id="orders-bulk-actions">
                        <div class="d-flex">
                            <select class="form-select form-select-sm" name="slAction" aria-label="Bulk actions">
                                <option value="sltNull" selected>Bulk actions</option>
                                <option value="confirmed">Đã xác nhận</option>
                                <option value="preparing_goods">Đang chuẩn bị hàng</option>
                                <option value="shipping">Đang vận chuyển</option>
                                <option value="delivered">Đã giao hàng</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="delete">Delete</option>
                            </select>
                            <input type="submit" class="btn btn-falcon-default btn-sm ms-2" name="btnApply" value="Apply">
                        </div>
                    </div>
                    <div id="orders-actions">
                        <button class="btn btn-falcon-default btn-sm mx-2" type="button">
                            <span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span>
                            <span class="d-none d-sm-inline-block ms-1">Filter</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive scrollbar">
                <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
                    <thead class="bg-200">
                        <tr>
                            <th>
                                <div class="form-check fs-9 mb-0 d-flex align-items-center">
                                    <input class="form-check-input" id="checkbox-bulk-customers-select" type="checkbox"
                                        data-bulk-select='{"body":"table-orders-body","actions":"orders-bulk-actions","replacedElement":"orders-actions"}' />
                                </div>
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="order">Order</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap pe-7" data-sort="date">Date</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="address"
                                style="min-width: 12.5rem;">Ship To</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-center" data-sort="status">
                                Status Orders
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-center" data-sort="status">
                                Status Payment
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap text-end" data-sort="amount">
                                Amount (VNĐ)
                            </th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-orders-body">
                        @php
                            $badgeColors = [
                                $statusOrder['reorder'] => 'info',
                                $statusOrder['pending'] => 'secondary',
                                $statusOrder['confirmed'] => 'dark',
                                $statusOrder['preparing_goods'] => 'primary',
                                $statusOrder['shipping'] => 'primary',
                                $statusOrder['delivered'] => 'primary',
                                $statusOrder['received'] => 'success',
                                $statusOrder['canceled'] => 'danger',
                                $statusPayment['paid'] => 'success',
                                $statusPayment['unpaid'] => 'danger',
                            ];
                        @endphp
                        @foreach ($dataO as $lOrders)
                            <tr class="btn-reveal-trigger">
                                <td class="align-middle" style="width: 28px;">
                                    <div class="form-check fs-9 mb-0 d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" name="idOrder[]" id="checkbox-0"
                                            data-bulk-select-row="data-bulk-select-row" value="{{ $lOrders->id }}" />
                                    </div>
                                </td>
                                <td class="order py-2 align-middle white-space-nowrap">
                                    <a href="order-details.html">
                                        <strong>#{{ $lOrders->id }}</strong>
                                    </a>
                                    by <strong>{{ $lOrders->user_name }}</strong>
                                    <br />
                                    <a href="mailto:{{ $lOrders->user_email }}">{{ $lOrders->user_email }}</a>
                                </td>
                                <td class="date py-2 align-middle">{{ $lOrders->date_create_order }}</td>
                                <td class="address py-2 align-middle white-space-nowrap">
                                    {{ $lOrders->user_address }}
                                </td>
                                <td class="status py-2 align-middle text-center fs-9 white-space-nowrap">
                                    <span
                                        class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$lOrders->status_order] }}">
                                        {{ $lOrders->status_order }}
                                    </span>
                                </td>
                                <td class="status py-2 align-middle text-center fs-9 white-space-nowrap">
                                    <span
                                        class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$lOrders->payment] }}">
                                        {{ $lOrders->payment }}
                                    </span>
                                </td>
                                <td class="amount py-2 align-middle text-end fs-9 fw-medium">
                                    {{ number_format((int) $lOrders->total_price, 0, ',', '.') }}
                                </td>
                                <td class="py-2 align-middle white-space-nowrap text-end">
                                    <div class="dropdown font-sans-serif position-static">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal"
                                            type="button" id="order-dropdown-0" data-bs-toggle="dropdown"
                                            data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                            <span class="fas fa-ellipsis-h fs-10"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end border py-0"
                                            aria-labelledby="order-dropdown-0">
                                            <div class="py-2">
                                                @if ($lOrders->status_order == 'Đã nhận hàng' && $lOrders->payment == 'Đã thanh toán')
                                                    <a class="dropdown-item text-primary" href="#!">Print invoice</a>
                                                @endif
                                                <a class="dropdown-item text-warning"
                                                    href="{{ route('admin.orders.detail', $lOrders->id) }}">Detail</a>
                                                <a class="dropdown-item text-danger" href="#!">Delete</a>
                                            </div>
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
            <div class="d-flex align-items-center justify-content-center">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous"
                    data-list-pagination="prev">
                    <span class="fas fa-chevron-left"></span>
                </button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next"
                    data-list-pagination="next">
                    <span class="fas fa-chevron-right"> </span>
                </button>
            </div>
        </div>
    </form>
@endsection
