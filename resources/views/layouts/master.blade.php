<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>@yield('title')</title>
    
    @include('admin.assets.styleCSS')
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
</body>

</html>
