@extends('layouts.nav')
@section('title', 'Document Type Edit')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Edit Document Type</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('document_types.index')}}">Document Types</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Document Type
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
            <h4 class="card-title">Add Document Type</h4>
        </div>
        <form method="POST" action="{{route('document_types.update',$documentType->id)}}">
            @method('PUT')
            @csrf
            <div class="row g-2 align-items-center">
                <div class="col-12">
                    <label class="form-label required">{{ __('Document Type') }}</label>
                    <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ $documentType->name,old('name')}}" required>
                </div>
                @if($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <div class="col-12">
                    <label class="form-label required">{{ __('Document Code') }}</label>
                    <input type="number" name="code" class="form-control form-control-lg @error('code') is-invalid @enderror" placeholder="{{ __('Code') }}" value="{{ $documentType->code,old('code')}}" required>
                </div>
                @if($errors->has('code'))
                    <div class="text-danger">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <div class="col-12">
                    <label class="form-label required @error('department_id') is-invalid @enderror">{{ __('Department') }}</label>
                    <label for="department_id"></label><select name="department_id" id="department_id" class="select2 form-select selectTwo @error('department_id') is-invalid @enderror">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}" @if($department->id == $documentType->department_id) selected @endif>{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('department_id'))
                    <div class="text-danger">
                        {{ $errors->first('department_id') }}
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{route('document_types.index')}}" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
