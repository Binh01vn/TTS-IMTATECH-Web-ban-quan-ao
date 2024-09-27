@extends('client.main-contents.accountDashBoard.index')
@section('subtitle')
    Account Dashboard - Orders
@endsection
@section('breadcrumb')
    Order detail
@endsection
@section('ctnt-dashboard')
    <div class="col-lg-8">
        <div class="card shadow-none mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <h5 class="mb-3">Billing Detail</h5>
                        <address>
                            Fullname: {{ $order->user_name }}<br>
                            Address: {{ $order->user_address }}<br>
                            Phone number: {{ $order->user_phone }}<br>
                            Email address: {{ $order->user_email }}<br>
                            Total order: {{ number_format((int) $order->total_price, 0, ',', '.') }} (VNĐ)
                        </address>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order item</th>
                                        <th>Products</th>
                                        <th>Images</th>
                                        <th>Rate (VNĐ)</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>#{{ $item->id }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>
                                                <img src="{{ \Storage::url($item->product_img_thumbnail) }}" alt="....."
                                                    width="50px">
                                            </td>
                                            <td>
                                                {{ number_format(
                                                    (int) ($item->product_sale_discount > 0
                                                        ? $item->product_price_regular * (1 - $item->product_sale_discount / 100)
                                                        : ($item->product_price_sale > 0
                                                            ? $item->product_price_sale
                                                            : $item->product_price_regular)),
                                                    0,
                                                    ',',
                                                    '.',
                                                ) }}
                                            </td>
                                            <td>
                                                {{ $item->quantity }}
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
@endsection
