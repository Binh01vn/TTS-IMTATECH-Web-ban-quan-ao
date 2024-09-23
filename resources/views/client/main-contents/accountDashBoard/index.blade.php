@extends('layouts.client')
@section('title')
    Account Dashboard
@endsection

@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">My Account</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Account</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
                    <h3 class="d-none">Account</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card shadow-none mb-3 mb-lg-0 border rounded-0">
                                        <div class="card-body">
                                            <div class="list-group list-group-flush">
                                                <a href="account-dashboard.html"
                                                    class="list-group-item active d-flex justify-content-between align-items-center">Dashboard
                                                    <i class='bx bx-tachometer fs-5'></i>
                                                </a>
                                                <a href="account-orders.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Orders
                                                    <i class='bx bx-cart-alt fs-5'></i>
                                                </a>
                                                <a href="account-downloads.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Downloads
                                                    <i class='bx bx-download fs-5'></i>
                                                </a>
                                                <a href="account-addresses.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Addresses
                                                    <i class='bx bx-home-smile fs-5'></i>
                                                </a>
                                                <a href="account-payment-methods.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Payment
                                                    Methods <i class='bx bx-credit-card fs-5'></i>
                                                </a>
                                                <a href="account-user-details.html"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Account
                                                    Details <i class='bx bx-user-circle fs-5'></i>
                                                </a>
                                                <a href="{{ route('auth.logout') }}"
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Logout
                                                    <i class='bx bx-log-out fs-5'></i>
                                                </a>
                                                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body">
                                            <p>Hello <strong>{{ $user->name }}</strong> (not
                                                <strong>{{ $user->name }}?</strong> <a href="{{ route('auth.logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>)
                                            </p>
                                            <p>From your account dashboard you can view your Recent Orders, manage your
                                                shipping and billing addesses and edit your password and account details</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </section>
            <!--end shop cart-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
