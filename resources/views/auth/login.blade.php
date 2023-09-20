@extends('layouts.app')
@section('body-class','blank-page')
@section('title', 'Login')
@section('main-content')
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-cover">
            <div class="auth-inner row m-2">
                <!-- Brand logo-->
                <a class="brand-logo" href="{{route('home')}}">
                     <span class="brand-logo d-inline-block">
                        <img src="/app-assets/images/logo/logo.png" width="100px" height="100px" alt="logo">
                     </span>
                    <h1 class="brand-text text-primary ms-1 d-inline-block">Office Automation System</h1>
                </a>
                <!-- /Brand logo-->
                <!-- Left Text-->
                <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                    <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="/app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
                </div>
                <!-- /Left Text-->
                <!-- Login-->
                <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                        <h2 class="card-title fw-bold mb-1">Office Automation System 👋</h2>
                        <p class="card-text mb-2">Please sign-in to your account.</p>
                        <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-1">
                                <label class="form-label" for="login-email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="login-email" type="text" name="email" value="{{ old('email') }}" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" required autocomplete="email"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="login-password">Password</label>
{{--                                    @if (Route::has('password.request'))--}}
{{--                                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                            {{ __('Forgot Your Password?') }}--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" required autocomplete="current-password" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                    <label class="form-check-label" for="remember-me"> Remember Me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" tabindex="4">Sign in</button>
                        </form>
                    </div>
                </div>
                <!-- /Login-->
            </div>
        </div>
    </div>
</div>
@endsection
