@extends('layouts.client')
@section('title')
    Shop Cart
@endsection

@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        @if (session('success'))
                            <h3 class="breadcrumb-title pe-3 text-success">{{ session('success') }}</h3>
                        @else
                            <h3 class="breadcrumb-title pe-3">Shop Cart</h3>
                        @endif
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shopHome') }}">
                                            <i class="bx bx-home-alt"></i> Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shop.shopIndex') }}">Shop</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Shop Cart</li>
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
                                    <div class="shop-cart-list mb-3 p-3">
                                        @foreach (session('cart') as $keyCart => $valCart)
                                            <div class="row align-items-center g-3">
                                                <div class="col-12 col-lg-6">
                                                    <div class="d-lg-flex align-items-center gap-3">
                                                        <div class="cart-img text-center text-lg-start">
                                                            <img src="{{ \Storage::url($valCart['image_thumbnail']) }}"
                                                                width="130" alt=".....">
                                                        </div>
                                                        <div class="cart-detail text-center text-lg-start">
                                                            <h6 class="mb-2">{{ $valCart['name'] }}</h6>
                                                            {{-- <p class="mb-0">
                                                                Size: <span>Regular</span>
                                                            </p>
                                                            <p class="mb-2">
                                                                Color: <span>White & Blue</span>
                                                            </p> --}}
                                                            <h5 class="mb-0">
                                                                {{ number_format(
                                                                    (int) ($valCart['sale_percent'] > 0
                                                                        ? $valCart['price_default'] * (1 - $valCart['sale_percent'] / 100)
                                                                        : ($valCart['price_sale'] > 0
                                                                            ? $valCart['price_sale']
                                                                            : $valCart['price_default'])),
                                                                    0,
                                                                    ',',
                                                                    '.',
                                                                ) }}
                                                                (VND)
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-3">
                                                    <div class="cart-action text-center">
                                                        <input type="number" class="form-control rounded-0"
                                                            value="{{ $valCart['quantityPRDC'] }}" min="1">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-3">
                                                    <div class="text-center">
                                                        <div
                                                            class="d-flex gap-3 justify-content-center justify-content-lg-end">
                                                            <a href="{{ route('cart.delOneCart', $keyCart) }}"
                                                                class="btn btn-outline-dark rounded-0 btn-ecomm">
                                                                <i class='bx bx-x'></i>Remove
                                                            </a>
                                                            <a href="javascript:;"
                                                                class="btn btn-light rounded-0 btn-ecomm">
                                                                <i class='bx bx-heart me-0'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                        <div class="d-lg-flex align-items-center gap-2">
                                            <a href="javascript:;" class="btn btn-dark btn-ecomm">
                                                <i class='bx bx-shopping-bag'></i> Continue Shoping
                                            </a>
                                            <a href="{{ route('cart.delOneCart', 'clearCart') }}"
                                                class="btn btn-light btn-ecomm ms-auto">
                                                <i class='bx bx-x-circle'></i> Clear Cart
                                            </a>
                                            {{-- <a href="javascript:;" class="btn btn-white btn-ecomm">
                                                <i class='bx bx-refresh'></i> Update Cart
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="checkout-form p-3 bg-light">
                                        <div class="card rounded-0 border bg-transparent shadow-none">
                                            <div class="card-body">
                                                <p class="fs-5">Apply Discount Code</p>
                                                <div class="input-group">
                                                    <input type="text" class="form-control rounded-0"
                                                        placeholder="Enter discount code">
                                                    <input class="btn btn-dark btn-ecomm" type="submit" name="bntDiscount"
                                                        value="Apply">
                                                    {{-- <button class="btn btn-dark btn-ecomm" type="button">Apply</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card rounded-0 border bg-transparent shadow-none">
                                            <div class="card-body">
                                                <p class="fs-5">Estimate Shipping and Tax</p>
                                                <div class="my-3 border-top"></div>
                                                <div class="mb-3">
                                                    <label class="form-label">Country Name</label>
                                                    <select class="form-select rounded-0">
                                                        <option selected>United States</option>
                                                        <option value="1">Australia</option>
                                                        <option value="2">India</option>
                                                        <option value="3">Canada</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">State/Province</label>
                                                    <select class="form-select rounded-0">
                                                        <option selected>California</option>
                                                        <option value="1">Texas</option>
                                                        <option value="2">Canada</option>
                                                    </select>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label">Zip/Postal Code</label>
                                                    <input type="email" class="form-control rounded-0">
                                                </div>
                                            </div>
                                        </div> --}}
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
                                                {{-- <p class="mb-2">
                                                    Taxes: <span class="float-end">$14.00</span>
                                                </p> --}}
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
                                                <div class="my-4"></div>
                                                <div class="d-grid"> <a href="{{ route('cart.checkoutCart') }}"
                                                        class="btn btn-dark btn-ecomm">Proceed to Checkout</a>
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
