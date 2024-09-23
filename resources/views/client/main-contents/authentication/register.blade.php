@extends('layouts.client')
@section('title')
    Register Account
@endsection

@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Sign Up</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Authentication</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="py-0 py-lg-5">
                <div class="container">
                    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5">
                        <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                            <div class="col mx-auto">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="border p-4 rounded">
                                            <div class="text-center">
                                                <h3 class="">Register</h3>
                                                <p>Already have an account?
                                                    <a href="{{ route('auth.login') }}">Sign in here</a>
                                                </p>
                                            </div>
                                            <div class="d-grid">
                                                <a class="btn my-4 shadow-sm btn-white" href="javascript:;">
                                                    <span class="d-flex justify-content-center align-items-center">
                                                        <img class="me-2"
                                                            src="{{ asset('theme/client/images/icons/search.svg') }}"
                                                            width="16" alt="Image Description">
                                                        <span>Register with Google</span>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="btn btn-white">
                                                    <i class="bx bxl-facebook">
                                                    </i>Register with Facebook</a>
                                            </div>
                                            <div class="login-separater text-center mb-4">
                                                <span>OR Register WITH EMAIL</span>
                                                <hr />
                                            </div>
                                            <div class="form-body">
                                                <form class="row g-3" action="{{ route('auth.reg') }}" method="POST">
                                                    @csrf
                                                    <div class="col-sm-6">
                                                        <label for="inputFirstName" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" id="inputFirstName"
                                                            name="name" value="{{ old('name') }}"
                                                            placeholder="Enter Full name">
                                                        @error('name')
                                                            <label
                                                                class="form-label text-danger"><strong>{{ $message }}</strong></label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Phone Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Phone number" name="phone_number"
                                                            value="{{ old('phone_number') }}">
                                                        @error('phone_number')
                                                            <label
                                                                class="form-label text-danger"><strong>{{ $message }}</strong></label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" id="address"
                                                            name="address" value="{{ old('address') }}"
                                                            placeholder="Enter Address">
                                                        @error('address')
                                                            <label
                                                                class="form-label text-danger"><strong>{{ $message }}</strong></label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputEmailAddress" class="form-label">Email
                                                            Address</label>
                                                        <input type="email" class="form-control" id="inputEmailAddress"
                                                            name="email" value="{{ old('email') }}"
                                                            placeholder="example@user.com">
                                                        @error('email')
                                                            <label
                                                                class="form-label text-danger"><strong>{{ $message }}</strong></label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                                        <div class="input-group" id="changeHide">
                                                            <input type="password" class="form-control border-end-0"
                                                                id="inputChoosePassword" name="password"
                                                                placeholder="Enter Password">
                                                            <a href="javascript:;" class="input-group-text bg-transparent">
                                                                <i class='bx bx-hide'></i>
                                                            </a>
                                                        </div>
                                                        @error('password')
                                                            <label
                                                                class="form-label text-danger"><strong>{{ $message }}</strong></label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="password_confirmation" class="form-label">Confirm
                                                            Password</label>
                                                        <div class="input-group" id="show_hide_password">
                                                            <input type="password" class="form-control border-end-0"
                                                                name="password_confirmation"
                                                                placeholder="Confirm Password">
                                                            <a href="javascript:;"
                                                                class="input-group-text bg-transparent">
                                                                <i class='bx bx-hide'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="flexSwitchCheckChecked" onclick="isChecked(this)">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">I
                                                                read and agree to Terms & Conditions</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 btn-reg"></div>
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
        function isChecked(checkbox) {
            let btnSubmit = document.querySelector('.col-12.btn-reg');
            if (checkbox.checked == true) {
                btnSubmit.innerHTML = `
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">
                            <i class='bx bx-user'></i>Register</button>
                    </div>
                `;
            } else {
                btnSubmit.innerHTML = '';
            }
        }
        $(document).ready(function() {
            function togglePassword(element) {
                const input = $(element).find('input');
                const icon = $(element).find('i');
                const isPassword = input.attr("type") === "password";
                input.attr('type', isPassword ? 'text' : 'password');
                icon.toggleClass("bx-hide bx-show");
            }

            $("#show_hide_password a, #changeHide a").on('click', function(event) {
                event.preventDefault();
                togglePassword($(this).closest('.input-group'));
            });
        });
    </script>
@endsection
