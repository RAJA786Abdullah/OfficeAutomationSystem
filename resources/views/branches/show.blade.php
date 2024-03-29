@extends('layouts.nav')
@section('title', 'User Show')
@section('app-content', 'app-content')

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
            @can('user_update')
                <div class="d-flex justify-content-between">
                    <form action="{{ route('printDocument') }}" method="post">
                        @csrf
                        <input type="hidden" name="documentID" value="{{ $document->id }}">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>&ensp;Print Document</button>
                    </form>
{{--                    <a href="{{ route('users.edit', $document->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i>&ensp;Edit Document</a>--}}
                </div>
            @endcan
        </div>
            <div class="card-body" >
                <div class="col-md-12">
                    <h3 class="text-center mb-1 mt-1">{{ strtoupper($document->classification->name) }}</h3>
                    <h3 class="text-center mb-1 mt-1">{{ strtoupper($document->documentType->name) }}</h3>
                    <h3 class="text-center mb-1 mt-1">{{ '('.strtoupper($document->department->name) .')' }}</h3>
                    <h3 class="mb-1 mt-1">Subj: <u><b> {{ $document->subject }} </b></u></h3>
{{--                    <h3 class="mb-1 mt-1">Signing Authority: <u> <b> {{ $document->user->name }} </b> </u></h3>--}}

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
                                                <p>{{ '( '.$signIn.' )' }}</p>
                                            @else
                                                <p>{{ $signIn }}</p>
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
                            @foreach($document->recipients as $index=>$recipient)
                                @if($recipient->type == 'to')
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">{{ $recipient->name }}</h5><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <h5 class="d-inline-block">Info:</h5>
                            @foreach($document->recipients as $index=>$recipient)
                                @if($recipient->type == 'info')
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 30px">{{ $recipient->name }}</h5>
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-12">
                            <h5 class="d-inline-block">ID:</h5>
                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<h5 class="d-inline-block" style="margin-left: 40px">Office Copy</h5><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </dl>
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
