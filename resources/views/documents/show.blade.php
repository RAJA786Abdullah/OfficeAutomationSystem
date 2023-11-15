@extends('layouts.nav')
@section('title', 'Document Show')
@section('app-content', 'app-content')
@php
    use PhpOffice\PhpSpreadsheet\IOFactory;
@endphp
@section('main-content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Document</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('documents.index')}}">Documents</a>
                            </li>
                            <li class="breadcrumb-item active">Document
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Page layout -->
        <div class="card p-5">
            <div class="card-header">
                <h3 class="mb-0 card-title"><i class="fa fa-user"></i> <b> {{\App\Models\Document::documentTitle($document->id)}} </b></h3>
                @can('documents_update')
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('printDocument') }}" method="post">
                            @csrf
                            <input type="hidden" name="documentID" value="{{ $document->id }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>&ensp;Print Document</button>
                        </form>
                    </div>
                @endcan
            </div>
            <div class="card-body" >
                <div class="col-md-12">
                    <h3 class="text-center">{{ strtoupper($document->classification->name) }}</h3>
                    <h3 class="text-center">{{ strtoupper($document->documentType->name) }}</h3>
                    <h3 class="text-center">{{ '('.strtoupper($document->department->name) .')' }}</h3>
                    <h3 class="mb-1 mt-1">Subj: <u><b> {{ $document->subject }} </b></u></h3>

                    <dl class="row">
                        <div class="col-md-12">
                            <dd class="fs-5">{!! $document['body'] !!}</dd>
                        </div>
                    </dl>

                    <dl class="row">
                        <div class="col-md-12  mt-2">
                            <b class="float-end">
                                <h4 style="text-align: right">
                                    @if($signInData)
                                        @foreach($signInData as $index=> $signIn)
                                            @if($loop->last)
                                                <p style="margin: 0;">{{ '( '.$signIn.' )' }}</p>
                                            @else
                                                <p style="margin: 0;">{{ $signIn }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </h4>
                            </b>
                        </div>
                    </dl>
                    <dl class="row">
                        <div class="col-md-12 text-center mt-2">
                            <b> <h4> {{\App\Models\Document::documentTitle($document->id)}} </h4></b>
                        </div>
                    </dl>
                    <dl class="row mt-3">
                        <div class="col-md-12">
                            <h5 class="d-inline-block">To:</h5>
                            @php $is_info=0; @endphp
                            @if($document->is_allDte == 1)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">All Dte</h5><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @else
                                @foreach($document->recipients as $index=>$recipient)
                                    @if($recipient->type == 'info')
                                        @php $is_info=1; @endphp
                                    @endif
                                    @if($recipient->type == 'to')
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">{{ $recipient->name }}</h5><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        @if($is_info == 1)
                        <div class="col-md-12">
                            <h5 class="d-inline-block">Info:</h5>
                            @foreach($document->recipients as $index=>$recipient)
                                @if($recipient->type == 'info')
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 30px">{{ $recipient->name }}</h5>
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endforeach
                        </div>
                        @endif

                        <div class="col-md-12">
                            <h5 class="d-inline-block">ID:</h5>
                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">Office Copy</h5><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </dl>

                    <dl>
                        <div class="col-md-12">
                            @foreach ($document->attachments as $attachment)
                                <embed src="{{ asset('storage/attachments/' . $attachment->path ) }}" width="100%" height="800px" type="application/pdf">
                            @endforeach
                        </div>
                    </dl>

                    @if( \Illuminate\Support\Facades\Auth::id() ==  $document->signing_authority_id)
                        <dl>
                            <form method="POST" action="{{route('remarks.store')}}">
                                <input type="hidden" name="document_id" value="{{ $document->id }}">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-7">
                                        <label for="remark" class="text-black fs-5">Add Remarks</label>
                                        <textarea class="mt-2 form-control" name="remark" id="remark" cols="60" rows="5" required> {{ old('remark') }}</textarea>
                                        @if($errors->has('remark'))
                                            <div class="text-danger">
                                                {{ $errors->first('remark') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-5">
                                        <label class="form-label required text-black mb-2 fs-5">{{ __('Send To') }}</label>
                                        <input type="hidden" name="toUser_id" value="{{ $document->created_by }}" >
                                        <p>{{ $document->user->name }}</p>
{{--                                        <select name="toUser_id" class="form-select selectTwo">--}}
{{--                                            <option disabled>Select User</option>--}}
{{--                                            @foreach ($departmentUsers as $departmentUser)--}}
{{--                                                <option value="{{ $departmentUser->userID }}">{{ $departmentUser->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}

                                        <button type="submit" class="mt-4 btn btn-primary">{{ __('Send') }}</button>
                                    </div>
                                </div>
                            </form>
                        </dl>
                    @endif
                    @if($document->remarks)
                        @foreach($document->remarks as $remarks)
                            <h5>From : {{ $remarks->user->name  }}</h5>
                            <p>Remark : {{ $remarks->remark  }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!--/ Page layout -->
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
