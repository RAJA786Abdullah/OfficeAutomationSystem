@extends('layouts.nav')
@section('title', 'Branch Edit')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Edit Branch</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('branches.index')}}">Branches</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Branch
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
            <h4 class="card-title">Add Branch</h4>
        </div>
        <form method="POST" action="{{route('branches.update',$branch->id)}}">
            @method('PUT')
            @csrf
            <div class="row g-2 align-items-center">
                <div class="col-12">
                    <label class="form-label required">{{ __('Branch Name') }}</label>
                    <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Document Name') }}" value="{{ $branch->name,old('name')}}" />
                </div>
                @if($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif

                <div class="col-12">
                    <label class="form-label required">{{ __('Location') }}</label>
                    <select name="location" id="location" class="form-select @error('location') is-invalid @enderror">
                        <option value="">Select Location</option>
                        <option value="lahore" @if($branch->location == 'lahore') selected @endif>Lahore</option>
                        <option value="islamabad" @if($branch->location == 'islamabad') selected @endif>Islamabad</option>
                        <option value="karachi" @if($branch->location == 'karachi') selected @endif>Karachi</option>
                        <option value="peshawar" @if($branch->location == 'peshawar') selected @endif>Peshawar</option>
                        <option value="multan" @if($branch->location == 'multan') selected @endif>Multan</option>
                    </select>
                </div>
                @if($errors->has('location'))
                    <div class="text-danger">
                        {{ $errors->first('location') }}
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{route('branches.index')}}" type="button" class="btn btn-secondary">Back</a>

            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
