<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>@yield('title')</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('theme/admin/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('theme/admin/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('theme/admin/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('theme/admin/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('theme/admin/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('theme/admin/assets/js/config.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/simplebar/simplebar.min.js') }}"></script>

    @include('admin.assets.styleCSS')
    @yield('css-libs')
    @yield('css-setting')
</head>

<body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            @include('admin.header.nav.nav-double-top')
            @include('admin.header.nav.nav-vertical')
            @include('admin.header.nav.nav-top')

            <div class="content">
                @include('admin.header.nav-vertical-content')
                @include('admin.header.nav-combo-content')
                @include('admin.header.settingNav')

                @yield('contents')

                @include('admin.footer.main-footer')
            </div>
            @include('admin.footer.modal-login')
        </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

    @include('admin.footer.settings-panel')
    @include('admin.footer.setting-toggle')

    @include('admin.assets.jsSetting')
    @yield('js-libs')
    @yield('js-setting')
</body>

</html>
