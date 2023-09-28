@extends('layouts.app')
@section('body-class','blank-page')
@section('title', 'User Login')
@section('main-content')
<div class="content-wrapper">
    <div class="content-body d-flex justify-content-center">
        <div class="content-header row"></div>
        <div class="auth-wrapper auth-basic ">
            <div class="auth-inner my-2 py-5 my-5">
                <!-- Login basic -->
                <div class="card" style="width: 30rem;">
                    <div class="card-body">
                        <h1>hello user</h1>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="me-50" data-feather="power"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <!-- /Login basic -->
            </div>
        </div>
    </div>
</div>
@endsection
