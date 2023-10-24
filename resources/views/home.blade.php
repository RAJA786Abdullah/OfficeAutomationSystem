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
                <div class="table-responsive-sm">
                    <table class="table mb-0 table-sm table-striped text-nowrap w-100 display">
                        <thead>
                        <tr>
                            <th class="wd-15p">#</th>
                            <th class="wd-25p">Subject</th>
                            <th class="wd-25p">Print</th>
                            <th class="wd-25p">Reply</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allDocuments as  $allDocument)
                            @foreach($userDocuments as $document)
                                @if ($allDocument->id == $document)
                                    @php
                                        $doc = \App\Models\Document::dashboardDocumentTitle($document);
                                        $count++;
                                    @endphp
                                    <tr>
                                        <td><span class="">{{ $count }}</span></td>
                                        <td>
                                            <span style="padding-left: 10px" >
                                                <b>
                                                    <a href="{{ route('docShow', $allDocument->id) }}" class="text-primary text-decoration-none">
                                                        {{ ucfirst($doc['subject']) . ' - ' . $doc['docTitle'] }}
                                                    </a>
                                                </b>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <form action="{{ route('printDocument') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="documentID" value="{{ $allDocument->id }}">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>&ensp;Print</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>Reply</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ Page layout -->
</div>

@endsection
@section('js')

@endsection
