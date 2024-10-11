@extends('layouts.client')
@section('title')
    About Us
@endsection

@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">About Us</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('shopHome') }}">
                                            <i class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Pages</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start page content-->
            <section class="py-0 py-lg-4">
                <div class="container">
                    <h4>Our Story</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.</p>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                        classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
                        professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
                        consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical
                        literature, discovered the undoubtable source.</p>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                        classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
                        professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
                        consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical
                        literature, discovered the undoubtable source.</p>
                </div>
            </section>
            <section class="py-4">
                <div class="container">
                    <h4>Why Choose Us</h4>
                    <hr>
                    <div class="row row-cols-1 row-cols-lg-3">
                        <div class="col d-flex">
                            <div class="card rounded-0 shadow-none w-100">
                                <div class="card-body">
                                    <img src="{{ asset('theme/client/images/icons/delivery.png') }}" width="60"
                                        alt="">
                                    <h5 class="my-3">FREE SHIPPING</h5>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industr in some form.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex">
                            <div class="card rounded-0 shadow-none w-100">
                                <div class="card-body">
                                    <img src="{{ asset('theme/client/images/icons/money-bag.png') }}" width="60"
                                        alt="">
                                    <h5 class="my-3">100% MONEY BACK GUARANTEE</h5>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industr in some form.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex">
                            <div class="card rounded-0 shadow-none w-100">
                                <div class="card-body">
                                    <img src="{{ asset('theme/client/images/icons/support.png') }}" width="60"
                                        alt="">
                                    <h5 class="my-3">ONLINE SUPPORT 24/7</h5>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industr in some form.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end start page content-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
