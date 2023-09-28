@extends('layouts.nav')
@section('title', 'User Create')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Add User</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">Add User
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
        <form method="POST" action="{{route('users.store')}}">
            <div class="card-body">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ old('name')}}" required>
                    </div>
                    @if($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label">{{ __('Arm Designation') }}</label>
                        <input type="text" name="arm_designation" class="form-control form-control-lg" placeholder="{{ __('Arm Designation') }}" value="{{ old('arm_designation')}}">
                    </div>

                    <div class="col-12">
                        <label class="form-label required">{{ __('User Name') }}</label><br>
                        <label class="form-label required">{{ __('User Name will be used for login username') }}</label>
                        <input type="text" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('User Name') }}" value="{{ old('email')}}" required>
                    </div>
                    @if($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Branch') }}</label>
                        <select name="branch_id" class="form-select selectTwo">
                            <option disabled>Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('branch_id'))
                        <div class="text-danger">
                            {{ $errors->first('branch_id') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Department') }}</label>
                        <select name="department_id" class="form-select selectTwo">
                            <option disabled>Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('departmentID'))
                        <div class="text-danger">
                            {{ $errors->first('departmentID') }}
                        </div>
                    @endif


                    <div class="col-12">
                        <label class="form-label required">{{ __('Role') }}</label>
                        <select name="roleID[]" class="form-select selectTwo" multiple>
                            <option disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->roleID }}" {{ old('roleID') == $role->roleID ? 'selected' : '' }}>{{ $role->roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('roleID'))
                        <div class="text-danger">
                            {{ $errors->first('roleID') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Is SignIn Authority') }}</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_signing_authority" id="yes" value="1" checked>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_signing_authority" id="no" value="0">
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label required">{{ __('Password') }}</label>
                        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" autocomplete="new-password">
                    </div>
                    @if($errors->has('password'))
                        <div class="text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Password confirmation') }}</label>
                        <input type="password" name="confirmPassword" class="form-control form-control-lg @error('confirmPassword') is-invalid @enderror" placeholder="{{ __('Password confirmation') }}" autocomplete="new-password">
                    </div>
                    @if($errors->has('confirmPassword'))
                        <div class="text-danger">
                            {{ $errors->first('confirmPassword') }}
                        </div>
                    @endif
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
