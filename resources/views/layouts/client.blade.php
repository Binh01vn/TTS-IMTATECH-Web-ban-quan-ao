<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index, follow" />
    <title>@yield('title')</title>
    <meta name="description" content="Jesco - Fashoin eCommerce HTML Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    @include('client.assets.styleCss')
    @yield('css-libs')
    @yield('css-setting')
</head>

<body>

    @include('client.header.header-main')
    @include('client.header.mini-wishlist')
    @include('client.header.mini-cart')
    @include('client.header.mobile-menu')


    @yield('contents')

    @include('client.footer.brand-area')
    @include('client.footer.footer-area')
    {{-- POPUP --}}
    @include('client.footer.popup-search')
    @include('client.footer.popup-login')
    {{-- POPUP end --}}

    <!-- Modal -->
    @include('client.footer.modal-2')
    <!-- Modal end -->

    @include('client.assets.javascript')
    @yield('js-libs')
    @yield('js-setting')
</body>

</html>
