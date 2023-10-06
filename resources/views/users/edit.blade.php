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
        <form method="POST" action="{{route('users.update',$user->userID)}}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('User Name') }}</label>
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ old('name',$user->name)}}" required>
                        @if($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label required">{{ __('Arm Designation') }}</label>
                        <input type="text" name="arm_designation" class="form-control form-control-lg" placeholder="{{ __('Arm Designation') }}" value="{{ old('arm_designation',$user->arm_designation)}}">
                    </div>

                    <div class="col-12">
                        <label class="form-label required">{{ __('User Name') }}</label>
                        <input type="text" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email',$user->email)}}" required>
                        @if($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label required">{{ __('Branch') }}</label>
                        <select name="branch_id" class="form-select selectTwo">
                            <option disabled>Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id', $user->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
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
                                <option value="{{ $department->id }}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
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
                                @foreach($user->roles as $userRole)
                                    <option value="{{ $role->roleID }}" {{ $role->roleID == $userRole->roleID ? 'selected' : '' }}>{{ $role->roleName }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('roleID'))
                        <div class="text-danger">
                            {{ $errors->first('roleID') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __(' Signing Authority') }}</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_signing_authority" id="yes" value="1" @if(old('is_signing_authority') == null || (old('is_signing_authority',$user->is_signing_authority) == '1')) checked @endif>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_signing_authority" id="no" value="0" @if((old('is_signing_authority',$user->is_signing_authority) == '0')) checked @endif>
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <label class="form-label required">{{ __('Status') }}</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="active" value="1" @if(old('status') == null || (old('status',$user->status) == '1')) checked @endif>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="notActive" value="0" @if((old('status',$user->status) == '0')) checked @endif>
                            <label class="form-check-label" for="notActive">Not Active</label>
                        </div>
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
