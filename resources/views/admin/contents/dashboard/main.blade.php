@extends('layouts.master')

@section('title')
    Admin Dashboard
@endsection

@section('contents')
    @include('admin.contents.dashboard.db1')
    @include('admin.contents.dashboard.db2')
    @include('admin.contents.dashboard.db3')
@endsection

@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/echarts/echarts.min.js') }}"></script>
@endsection
