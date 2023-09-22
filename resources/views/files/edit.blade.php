@extends('layouts.nav')
@section('title', 'File Edit')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Edit File</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('files.index')}}">Files</a>
                        </li>
                        <li class="breadcrumb-item active">Edit File
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
            <h4 class="card-title">Add File</h4>
        </div>
        <form method="POST" action="{{route('files.update',$file->id)}}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('File Name') }}</label>
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ $file->name,old('name')}}" required>
                    </div>
                    @if($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('File Code') }}</label>
                        <input type="text" name="code" class="form-control form-control-lg @error('code') is-invalid @enderror" placeholder="{{ __('Code') }}" value="{{ $file->code,old('code')}}" required>
                    </div>
                    @if($errors->has('code'))
                        <div class="text-danger">
                            {{ $errors->first('code') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{route('files.index')}}" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
