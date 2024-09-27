@extends('client.main-contents.accountDashBoard.index')
@section('subtitle')
    Account Dashboard
@endsection
@section('breadcrumb')
    My Account
@endsection
@section('ctnt-dashboard')
    <div class="col-lg-8">
        <div class="card shadow-none mb-0">
            <div class="card-body">
                <p>Hello <strong>{{ $user->name }}</strong> (not
                    <strong>{{ $user->name }}?</strong> <a href="{{ route('auth.logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>)
                </p>
                <p>From your account dashboard you can view your Recent Orders, manage your
                    shipping and billing addesses and edit your password and account details</p>
            </div>
        </div>
    </div>
@endsection
