@extends('layouts.nav')
@section('title', 'Attachment Create')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Add Attachment</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('attachments.index')}}">Attachments</a>
                        </li>
                        <li class="breadcrumb-item active">Add Attachment
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
            <h4 class="card-title">Add Attachment</h4>
        </div>
        <form method="POST" action="{{route('users.store')}}">
            <div class="card-body">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('Attachment Name') }}</label>
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="{{ __('Name') }}" value="{{ old('name')}}" required>
                        <select class="form-select @error('document_id') is-invalid @enderror" name="document_id" id="document_id">
                            <option value="">Select Document</option>
                            @foreach($documents as $document)
                                <option value="{{$document->id}}">{{\App\Models\Document::documentTitle($document->id)}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Role') }}</label>
                        <select name="roleID[]" class="form-select form-select-lg" multiple>
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
                        <label class="form-label required">{{ __('Email address') }}</label>
                        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email')}}" required>
                    </div>
                    @if($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
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
