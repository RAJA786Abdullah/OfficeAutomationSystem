@extends('layouts.nav')
@section('title', 'Regional Office Edit')
@section('app-content', 'app-content')

@section('main-content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit Regional Office</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('branches.index')}}">Regional Offices</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Regional Office
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
                <h4 class="card-title">Add Regional Office</h4>
            </div>
            <form method="POST" action="{{route('branches.update',$branch->id)}}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-12">
                            <label class="form-label required">{{ __('Regional Office Name') }}</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Regional Office Name') }}" value="{{ $branch->name,old('name')}}"/>
                        </div>
                        @if($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <div class="col-12">
                            <label class="form-label required">{{ __('Location') }}</label>
                            <select name="location" id="location"
                                    class="form-select @error('location') is-invalid @enderror">
                                <option value="">Select Location</option>
    {{--                            <option value="Quetta" @if($branch->location == 'Quetta') selected @endif>Quetta</option>--}}
                                <option value="Lahore" @if($branch->location == 'Lahore') selected @endif>Lahore</option>
                                <option value="Islamabad" @if($branch->location == 'Islamabad') selected @endif>Islamabad</option>
                                <option value="Karachi" @if($branch->location == 'Karachi') selected @endif>Karachi</option>
                                <option value="Peshawar" @if($branch->location == 'Peshawar') selected @endif>Peshawar</option>
                                <option value="Multan" @if($branch->location == 'Multan') selected @endif>Multan</option>
                            </select>
                        </div>
                        @if($errors->has('location'))
                            <div class="text-danger">
                                {{ $errors->first('location') }}
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            <a href="{{route('branches.index')}}" type="button" class="btn btn-secondary">Back</a>
        </div>
        <!--/ Page layout -->
    </div>
@endsection
