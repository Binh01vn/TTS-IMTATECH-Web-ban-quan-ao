@extends('layouts.client')
@section('title')
    Procced to checkout
@endsection
@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Checkout</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shopHome') }}">
                                            <i class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('shop.shopIndex') }}">Shop</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="py-4">
                <div class="container">
                    <div class="shop-cart">
                        @if (session()->has('cart') && count(session('cart')) > 0)
                            <div class="row">
                                <div class="col-12 col-xl-8">
                                    <div class="checkout-details">
                                        <div class="card rounded-0">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="ms-2">
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <p class="mb-0">{{ $user->email }}</p>
                                                    </div>
                                                    <div class="ms-auto"> <a href="javascript:;"
                                                            class="btn btn-light btn-ecomm"><i class='bx bx-edit'></i> Edit
                                                            Profile</a>
                                                    </div>
                                                </div>
                                                <div class="border p-3">
                                                    <h2 class="h5 mb-0">Shipping Address</h2>
                                                    <div class="my-3 border-bottom"></div>
                                                    <div class="form-body">
                                                        <form class="row g-3" action="{{ route('cart.saveOrder') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <label class="form-label">First Name</label>
                                                                <input type="text" class="form-control rounded-0"
                                                                    name="fullname" value="{{ $user->name }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Email Address</label>
                                                                <input type="email" class="form-control rounded-0"
                                                                    name="email" value="{{ $user->email }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Phone Number</label>
                                                                <input type="text" class="form-control rounded-0"
                                                                    name="phone_number" value="0{{ $user->phone_number }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Address</label>
                                                                <textarea class="form-control rounded-0" name="address">{{ $user->address }}</textarea>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Note</label>
                                                                <textarea class="form-control rounded-0" name="note" placeholder="Nhập ghi chú của bạn tại đây!"></textarea>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Payment method</label>
                                                                <select class="form-select rounded-0" name="payment_method"
                                                                    onchange="selectMethod(this)">
                                                                    <option value="null">Select method</option>
                                                                    <option value="cod">COD</option>
                                                                    <option value="vnpay_card">VNPAY CARD</option>
                                                                    <option value="momo_card">MOMO CARD</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="d-grid">
                                                                    <a href="{{ route('cart.shopCart') }}"
                                                                        class="btn btn-light btn-ecomm">
                                                                        <i class='bx bx-chevron-left'></i>Back to Cart
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 btnCheckout"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="order-summary">
                                        <div class="card rounded-0">
                                            <div class="card-body">
                                                <div class="card rounded-0 border bg-transparent shadow-none">
                                                    <div class="card-body">
                                                        <p class="fs-5">Order summary</p>
                                                        <div class="my-3 border-top"></div>
                                                        @foreach (session('cart') as $item)
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-block flex-shrink-0" href="javascript:;">
                                                                    <img src="{{ \Storage::url($item['image_thumbnail']) }}"
                                                                        width="75" alt=".....">
                                                                </a>
                                                                <div class="ps-2">
                                                                    <h6 class="mb-1"><a href="javascript:;"
                                                                            class="text-dark">{{ $item['name'] }}</a></h6>
                                                                    <div class="widget-product-meta">
                                                                        <span class="me-2">
                                                                            {{ number_format(
                                                                                (int) ($item['sale_percent'] > 0
                                                                                    ? $item['price_default'] * (1 - $item['sale_percent'] / 100)
                                                                                    : ($item['price_sale'] > 0
                                                                                        ? $item['price_sale']
                                                                                        : $item['price_default'])),
                                                                                0,
                                                                                ',',
                                                                                '.',
                                                                            ) }}
                                                                            (VNĐ)
                                                                        </span>
                                                                        <span class="">
                                                                            x {{ $item['quantityPRDC'] }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="my-3 border-top"></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="card rounded-0 border bg-transparent mb-0 shadow-none">
                                                    <div class="card-body">
                                                        @foreach (session('cart') as $keyCart => $valPRD)
                                                            <p class="mb-2">
                                                                {{ $valPRD['name'] }} x {{ $valPRD['quantityPRDC'] }}:
                                                                <span class="float-end">
                                                                    {{ number_format(
                                                                        (int) ($valPRD['sale_percent'] > 0
                                                                            ? $valPRD['price_default'] * (1 - $valPRD['sale_percent'] / 100) * $valPRD['quantityPRDC']
                                                                            : ($valPRD['price_sale'] > 0
                                                                                ? $valPRD['price_sale'] * $valPRD['quantityPRDC']
                                                                                : $valPRD['price_default'] * $valPRD['quantityPRDC'])),
                                                                        0,
                                                                        ',',
                                                                        '.',
                                                                    ) }}
                                                                </span>
                                                            </p>
                                                        @endforeach
                                                        <p class="mb-2">Shipping:
                                                            <span class="float-end">--</span>
                                                        </p>
                                                        <p class="mb-2">Discount:
                                                            <span class="float-end">--</span>
                                                        </p>
                                                        <p class="mb-0">Subtotal: <span class="float-end">
                                                                @if (session()->has('totalAmount'))
                                                                    {{ number_format((int) session('totalAmount'), 0, ',', '.') }}
                                                                @endif
                                                            </span>
                                                        </p>
                                                        <div class="my-3 border-top"></div>
                                                        <h5 class="mb-0">Order Total:
                                                            <span class="float-end">
                                                                @if (session()->has('totalAmount'))
                                                                    {{ number_format((int) session('totalAmount'), 0, ',', '.') }}
                                                                    (VNĐ)
                                                                @endif
                                                            </span>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <h3 class="col-12 col-xl-12">Không có sản phẩm nào trong giỏ hàng!</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <!--end shop cart-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
@section('js-setting')
    <script>
        function selectMethod(selectValue) {
            let method = selectValue.value;
            let btnCheckout = document.querySelector('div.col-md-6.btnCheckout');
            let html;
            if (method == "null") {
                btnCheckout.innerHTML = '';
            } else {
                btnCheckout.innerHTML = `
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-ecomm">
                        Proceed to Checkout
                        <i class='bx bx-chevron-right'></i>
                    </button>
                </div>
                `;
            }
        }
    </script>
@endsection
