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
        <form method="POST" action="{{route('attachments.store')}}">
            <div class="card-body">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-12">
                        <label class="form-label required">{{ __('Document') }}</label>
                        <select name="document_id" id="document_id" class="form-select selectTwo @error('document_id') is-invalid @enderror">
                            <option value="">Select Document</option>
                            @foreach($documents as $document)
                                <option value="{{$document->id}} @if($document->id == old('document_id')) selected @endif">{{\App\Models\Document::documentTitle($document->id)}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('document_id'))
                        <div class="text-danger">
                            {{ $errors->first('document_id') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Document Type') }}</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="">Select Document Type</option>
                            <option value="word">Word</option>
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                            <option value="img">Image</option>
                        </select>
                    </div>
                    @if($errors->has('type'))
                        <div class="text-danger">
                            {{ $errors->first('type') }}
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label required">{{ __('Choose File') }}</label>
                        <input type="file" name="path" class="form-control form-control-lg @error('path') is-invalid @enderror" placeholder="{{ __('Choose File') }}" value="{{ old('path')}}">
                    </div>
                    @if($errors->has('path'))
                        <div class="text-danger">
                            {{ $errors->first('path') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <a href="{{route('attachments.index')}}" type="button" class="btn btn-secondary">Back</a>

            </div>
        </form>
    </div>
    <!--/ Page layout -->
</div>
@endsection
