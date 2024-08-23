@extends('layouts.client')
@section('title')
    Jesco
@endsection

@section('contents')
    @include('client.contents-main.home.intro-slider')
    @include('client.contents-main.home.banner-area')
    @include('client.contents-main.home.feature-area')

    @include('client.contents-main.home.product-testimonial.product-area')
    @include('client.contents-main.home.product-testimonial.deal-area')
    @include('client.contents-main.home.product-testimonial.testimonial-area')
@endsection
