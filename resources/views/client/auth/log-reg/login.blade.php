@extends('layouts.client')
@section('title')
    Đăng nhập tài khoản
@endsection

@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Đăng nhập</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            <i class="bx bx-home-alt"></i>Trang chủ
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Tài khoản</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="">
                <div class="container">
                    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5">
                        <div class="row row-cols-1 row-cols-xl-2">
                            <div class="col mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="border p-4 rounded">
                                            @if (Route::has('auth.register'))
                                                <div class="text-center">
                                                    <h3 class="">Đăng nhập</h3>
                                                    <p>Bạn chưa có tài khoản? <a href="{{ route('auth.register') }}">Đăng ký
                                                            tại đây</a>
                                                    </p>
                                                </div>
                                            @endif
                                            <div class="d-grid">
                                                <a class="btn my-4 shadow-sm btn-white" href="{{ route('auth.google') }}">
                                                    <span class="d-flex justify-content-center align-items-center">
                                                        <img class="me-2"
                                                            src="{{ asset('theme/client/images/icons/search.svg') }}"
                                                            width="16" alt="Image Description">
                                                        <span>Đăng nhập với Google</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="login-separater text-center mb-4">
                                                <span>HOẶC ĐĂNG NHẬP VỚI EMAIL</span>
                                                <hr />
                                            </div>
                                            <div class="form-body">
                                                <form class="row g-3" action="" method="POST">
                                                    @csrf
                                                    <div class="col-12">
                                                        <label for="inputEmailAddress" class="form-label">Địa chỉ
                                                            email</label>
                                                        <input type="email" class="form-control" id="inputEmailAddress"
                                                            name="email" value="{{ old('email') }}"
                                                            placeholder="Email Address">
                                                        @error('email')
                                                            <label class="form-label text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputChoosePassword" class="form-label">Nhập mật
                                                            khẩu</label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" class="form-control border-end-0"
                                                                id="inputChoosePassword" name="password"
                                                                placeholder="Mật khẩu">
                                                            <a href="javascript:;" class="input-group-text bg-transparent">
                                                                <i class='bx bx-hide'></i>
                                                            </a>
                                                        </div>
                                                        @error('password')
                                                            <label class="form-label text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="remember"
                                                                name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="remember">Ghi nhớ
                                                                tôi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 text-end"> <a
                                                            href="authentication-forgot-password.html">Bạn quyên mật
                                                            khẩu?</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-dark">
                                                                <i class="bx bxs-lock-open"></i>Đăng nhập</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
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
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
@endsection
