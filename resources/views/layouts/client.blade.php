<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!--favicon-->
    <link rel="icon" href="{{ asset('theme/client/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('theme/client/plugins/OwlCarousel/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/client/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('theme/client/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('theme/client/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('theme/client/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('theme/client/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/client/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/client/css/icons.css') }}" rel="stylesheet">
    @yield('css-libs')
    @yield('css-setting')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start top header wrapper-->
        <div class="header-wrapper">
            @include('client.header-wrapper.top-menu')
            @include('client.header-wrapper.header-content')
            @include('client.header-wrapper.primary-menu')
        </div>
        <!--end top header wrapper-->
        @yield('contents')

        @include('client.footer')
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top">
            <i class='bx bxs-up-arrow-alt'></i>
        </a>
        <!--End Back To Top Button-->
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ asset('theme/client/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('theme/client/js/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/client/plugins/OwlCarousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('theme/client/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js') }}"></script>
    @yield('js-libs')
    <script src="{{ asset('theme/client/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('theme/client/js/app.js') }}"></script>
    <script src="{{ asset('theme/client/js/index.js') }}"></script>
    @yield('js-setting')
</body>

</html>
