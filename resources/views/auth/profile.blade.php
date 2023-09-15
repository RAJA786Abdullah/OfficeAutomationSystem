@extends('layouts.nav')
@section('title', 'Profile')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Profile</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Profile
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Page layout -->
    <div class="card">
        @include('partials.message')
        <div class="card-header">
            <h4 class="card-title">Profile</h4>
        </div>
        <form action="{{ route('profile.update') }}" method="POST" class="card form-vertical" autocomplete="off">
            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                    @if($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <label class="form-label required">{{ __('Email address') }}</label>
                        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                    @if($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <label class="form-label required">Old Password</label>
                        <input type="password" class="form-control form-control-lg" name="oldPassword" placeholder="Enter Old Password">
                        @if($errors->has('oldPassword'))
                            <div class="text-danger">
                                {{ $errors->first('oldPassword') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label required">{{ __('New password') }}</label>
                        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('New password') }}">
                    </div>
                    @if($errors->has('password'))
                        <div class="text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('New password confirmation') }}</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('New password confirmation') }}" autocomplete="new-password">
                    </div>
                    @if($errors->has('password_confirmation'))
                        <div class="text-danger">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
