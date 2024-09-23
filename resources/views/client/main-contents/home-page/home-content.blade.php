@extends('layouts.client')
@section('title')
    Home Shopingo
@endsection

@section('contents')
    @include('client.main-contents.home-page.slider-section')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            @include('client.main-contents.home-page.information-pramotion')
            @include('client.main-contents.home-page.product-home.featured-product')
            @include('client.main-contents.home-page.product-home.new-arrivals')
            @include('client.main-contents.home-page.banner-support_infor.banners')
            @include('client.main-contents.home-page.banner-support_infor.support-info')
            @include('client.main-contents.home-page.news')
        </div>
    </div>
    <!--end page wrapper -->
@endsection
