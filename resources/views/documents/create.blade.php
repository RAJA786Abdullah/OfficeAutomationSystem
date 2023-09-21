@extends('layouts.nav')
@section('title', 'Document Create')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Add Document</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('documents.index')}}">Documents</a>
                        </li>
                        <li class="breadcrumb-item active">Add Document
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
            <h4 class="card-title">Add Document</h4>
        </div>
        <form method="POST" action="{{route('documents.store')}}">
            <div class="card-body">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('Classification') }}</label>
                        <select name="classification_id" class="form-select">
                            <option disabled>Select Classification</option>
                            @foreach ($classifications as $classification)
                                <option value="{{ $classification->id }}" {{ old('classification_id') == $classification->id ? 'selected' : '' }}>{{ $classification->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('classification_id'))
                        <div class="text-danger">
                            {{ $errors->first('classification_id') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Document Type') }}</label>
                        <select name="document_type_id" class="form-select">
                            <option disabled>Select Document Type</option>
                            @foreach ($documentTypes as $documentType)
                                <option value="{{ $documentType->id }}" {{ old('document_type_id') == $documentType->id ? 'selected' : '' }}>{{ $documentType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('document_type_id'))
                        <div class="text-danger">
                            {{ $errors->first('document_type_id') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('File') }}</label>
                        <select name="file_code" class="form-select">
                            <option disabled>Select File</option>
                            @foreach ($files as $file)
                                <option value="{{ $file->code }}" {{ old('file_code') == $file->code ? 'selected' : '' }}>{{ $file->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('file_code'))
                        <div class="text-danger">
                            {{ $errors->first('file_code') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Subject') }}</label>
                        <input type="text" name="subject" class="form-control" required placeholder="Subject">
                    </div>
                    @if($errors->has('subject'))
                        <div class="text-danger">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Body') }}</label>
                        <textarea name="body" id="body" class="form-control"></textarea>
                    </div>
                    @if($errors->has('body'))
                        <div class="text-danger">
                            {{ $errors->first('body') }}
                        </div>
                    @endif




                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{route('documents.index')}}" type="button" class="btn btn-secondary">Back</a>

            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
