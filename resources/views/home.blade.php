@extends('layouts.nav')
@section('title', 'Dashboard')
@section('more-style')

@endsection
@section('main-content')
{{--<div class="content-header row">--}}
{{--    <div class="content-header-left col-md-9 col-12 mb-2">--}}
{{--        <div class="row breadcrumbs-top">--}}
{{--            <div class="col-12">--}}
{{--                <h2 class="content-header-title float-start mb-0">Dashboard</h2>--}}
{{--                <div class="breadcrumb-wrapper">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>--}}
{{--                        </li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="content-body">
    <!-- Page layout -->
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-start">
            <a class="btn btn-primary btn-sm" href="#" role="button">Received Document</a>
            <a class="btn btn-primary btn-sm" style="margin-left: 10px" href="#" role="button">Sent Document</a>
        </div>
        <div class="card-body">
            <div class="card-text">
                <div class="card-header d-flex justify-content-start">
                    <a class="btn btn-outline-primary rounded-pill btn-sm" href="#" role="button">Preview</a>
                    <a class="btn btn-outline-primary rounded-pill btn-sm" style="margin-left: 10px" href="#" role="button">Info</a>
                    <a class="btn btn-outline-primary rounded-pill btn-sm" style="margin-left: 10px" href="#" role="button">Tracking</a>
                </div>
                <!-- Your content here -->
                @php
                    $count = 0;
                @endphp
                @foreach($allDocuments as  $allDocument)
                    @foreach($userDocuments as $document)
                        @if ($allDocument->id == $document)
                            @php
                                $doc = \App\Models\Document::dashboardDocumentTitle($document);
                                $count++;
                            @endphp
{{--                            <a href="{{ route('documents.show', $allDocument->id) }}" class=" text-primary mt-1">--}}
{{--                                <b>{{ ucfirst($doc['subject']) . ' - ' . $doc['docTitle'] }}</b>--}}
{{--                            </a><br>--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-1">--}}
{{--                                {{ $count }}--}}
{{--                            </div>--}}
{{--                            <div class="col-11" style="margin-left: ">--}}
{{--                                <u><b><a href="{{ route('documents.show', $allDocument->id) }}" class="text-primary text-decoration-none">{{ ucfirst($doc['subject']) . ' - ' . $doc['docTitle'] }}</a></b></u>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                            <span class="">{{ $count }}</span>
                            <span style="padding-left: 10px" ><u><b><a href="{{ route('docShow', $allDocument->id) }}" class="text-primary text-decoration-none">{{ ucfirst($doc['subject']) . ' - ' . $doc['docTitle'] }}</a></b></u></span>
                            <br>

{{--                            {{ $count }} - <b><h4><u><a href="{{ route('documents.show', $allDocument->id) }}" class="text-primary text-decoration-none">{{ $doc['subject'] . ' - ' . $doc['docTitle'] }}</a></u></h4></b>--}}
{{--                            <b><h4><a href="{{ route('documents.show', $allDocument->id) }}">{{ $doc['subject'] . ' - ' . $doc['docTitle'] }}</a></h4></b>--}}
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <!--/ Page layout -->
</div>

@endsection
@section('js')

@endsection
