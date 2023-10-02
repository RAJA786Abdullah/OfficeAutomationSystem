@extends('layouts.nav')
@section('title', 'User Edit')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Edit User</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">Edit User
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
            <h4 class="card-title">Add User</h4>
        </div>
        <form method="POST" action="{{route('documents.update',$document->id)}}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col-12">

                    </div>
                    <div class="col-12">

                    </div>
                    <div class="col-12">
                        <label class="form-label required">{{ __('Old Password') }}</label>
                        <input type="password" name="oldPassword" class="form-control form-control-lg @error('oldPassword') is-invalid @enderror" placeholder="{{ __('Old Password') }}">
                        @if($errors->has('oldPassword'))
                            <div class="text-danger">
                                {{ $errors->first('oldPassword') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label required">{{ __('Password') }}</label>
                        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                        @if($errors->has('password'))
                            <div class="text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label required">{{ __('Password confirmation') }}</label>
                        <input type="password" name="confirmPassword" class="form-control form-control-lg @error('confirmPassword') is-invalid @enderror" placeholder="{{ __('Password confirmation') }}">
                        @if($errors->has('confirmPassword'))
                            <div class="text-danger">
                                {{ $errors->first('confirmPassword') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{route('users.index')}}" type="button" class="btn btn-secondary">Back</a>

            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
