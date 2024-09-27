@extends('client.main-contents.accountDashBoard.index')
@section('subtitle')
    Account Dashboard - Orders
@endsection
@section('breadcrumb')
    My Orders
@endsection
@section('ctnt-dashboard')
    <div class="col-lg-8">
        <div class="card shadow-none mb-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Status Orders</th>
                                <th>Status Payment</th>
                                <th>Total (VNĐ)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $badgeColors = [
                                    $statusOrder['reorder'] => 'bg-info',
                                    $statusOrder['pending'] => 'bg-secondary',
                                    $statusOrder['confirmed'] => 'bg-dark',
                                    $statusOrder['preparing_goods'] => 'bg-primary',
                                    $statusOrder['shipping'] => 'bg-primary',
                                    $statusOrder['delivered'] => 'bg-primary',
                                    $statusOrder['received'] => 'bg-success',
                                    $statusOrder['canceled'] => 'bg-danger',
                                    $statusPayment['paid'] => 'bg-success',
                                    $statusPayment['unpaid'] => 'bg-danger',
                                ];
                            @endphp
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->date_create_order }}</td>
                                    <td>
                                        <div class="badge rounded-pill {{ $badgeColors[$order->status_order] }} w-100">
                                            {{ $order->status_order }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge rounded-pill {{ $badgeColors[$order->payment] }} w-100">
                                            {{ $order->payment }}
                                        </div>
                                    </td>
                                    <td>{{ number_format((int) $order->total_price, 0, ',', '.') }} for
                                        {{ count($order->items) }} item</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('dashboard.detailOrder', $order->id) }}"
                                                class="btn btn-dark btn-sm rounded-0">View</a>
                                            @if ($order->status_order == 'Đơn hàng bị hủy')
                                                <a href="javascript:;" class="btn btn-dark btn-sm rounded-0">Reorder</a>
                                            @endif
                                            @if ($order->status_order != 'Đơn hàng bị hủy' && $order->status_order == 'Đã giao hàng')
                                                <a href="{{ route('dashboard.updateStatus', $order->id) }}"
                                                    class="btn btn-success btn-sm rounded-0"
                                                    onclick="return confirm('Bạn xác nhận đã nhận được đơn hàng và thanh toán?')">Received</a>
                                            @endif
                                            {{-- <a href="javascript:;" class="btn btn-dark btn-sm rounded-0">Cancel</a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
