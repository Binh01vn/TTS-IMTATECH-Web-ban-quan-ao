@extends('layouts.client')
@section('title')
    Contact
@endsection

@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Contact Us</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ route('shopHome') }}"><i
                                                class="bx bx-home-alt"></i> Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Pages</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start page content-->
            <section class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="p-3 bg-light">
                                <form>
                                    <div class="form-body">
                                        <h6 class="mb-0 text-uppercase">Drop us a line</h6>
                                        <div class="my-3 border-bottom"></div>
                                        <div class="mb-3">
                                            <label class="form-label">Enter Your Name</label>
                                            <input type="text" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Enter Email</label>
                                            <input type="text" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" rows="4" cols="4"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-dark btn-ecomm">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="p-3 bg-light">
                                <div class="address mb-3">
                                    <h6 class="mb-0 text-uppercase">Address</h6>
                                    <p class="mb-0 font-12">123 Street Name, City, Australia</p>
                                </div>
                                <div class="phone mb-3">
                                    <h6 class="mb-0 text-uppercase">Phone</h6>
                                    <p class="mb-0 font-13">Toll Free (123) 472-796</p>
                                    <p class="mb-0 font-13">Mobile : +91-9910XXXX</p>
                                </div>
                                <div class="email mb-3">
                                    <h6 class="mb-0 text-uppercase">Email</h6>
                                    <p class="mb-0 font-13">mail@example.com</p>
                                </div>
                                <div class="working-days mb-3">
                                    <h6 class="mb-0 text-uppercase">WORKING DAYS</h6>
                                    <p class="mb-0 font-13">Mon - FRI / 9:30 AM - 6:30 PM</p>
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
