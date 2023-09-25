@extends('layouts.app')
@section('body-class','blank-page')
@section('title', 'User Login')
@section('main-content')
    <div class="content-wrapper">
        <div class="content-body d-flex justify-content-center">
            <div class="content-header row"></div>
            <div class="auth-wrapper auth-basic ">
                <div class="auth-inner my-5">
                    <!-- Login basic -->
                    <div class="card" style="width: 30rem;">
                        <div class="card-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 px-xl-2 mx-auto">
                            <span class="brand-logo d-flex justify-content-center">
                                <img src="/app-assets/images/logo/logo.png" width="100px" height="100px" alt="logo">
                            </span>
                                <h1 class="card-title fw-bold mb-1 d-flex justify-content-center my-2">Office Automation System</h1>
                                <p class="card-text mb-2 my-2">Please sign-in to your account.</p>
                                <form class="auth-login-form mt-2" action="{{ route('front-login') }}" method="POST">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="login-email">User Name</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="login-email" type="text" name="email" value="{{ old('email') }}" placeholder="john123" aria-describedby="login-email" autofocus="" tabindex="1" required autocomplete="email"/>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password">Password</label>
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
                    </div>
                    <!-- /Login basic -->
                </div>
            </div>
        </div>
    </div>
@endsection
