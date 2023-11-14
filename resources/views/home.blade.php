@extends('layouts.nav')
@section('title', 'Dashboard')
@section('more-style')

@endsection
@section('main-content')
<div class="content-body opacity">
    <!-- Page layout -->
    <div class="col-md-12">
        <div class="card text-center mb-3">
            <div class="card-header pt-1">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-new" aria-controls="navs-tab-new" aria-selected="true">
                            New
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-sent" aria-controls="navs-tab-sent" aria-selected="false" tabindex="-1">
                            Sent
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-received" aria-controls="navs-tab-received" aria-selected="false" tabindex="-2">
                            Received
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-3">
                <div class="tab-content p-0">
                    <div class="tab-pane fade active show" id="navs-tab-new" role="tabpanel">
                        <h5 class="card-title">Special title New</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="tab-pane fade" id="navs-tab-sent" role="tabpanel">
                        <h5 class="card-title">Special title Sent</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="tab-pane fade" id="navs-tab-received" role="tabpanel">
                        <h5 class="card-title">Special title Recieved</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="card ">--}}
{{--        <div class="card-header pb-0 d-flex justify-content-start">--}}
{{--            <a class="btn btn-primary btn-sm" href="#" role="button">Received Document</a>--}}
{{--            <a class="btn btn-primary btn-sm" style="margin-left: 10px" href="#" role="button">Sent Document</a>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <div class="card-text">--}}
{{--                <div class="card-header d-flex justify-content-start">--}}
{{--                    <a class="btn btn-outline-primary rounded-pill btn-sm" href="#" role="button">Preview</a>--}}
{{--                    <a class="btn btn-outline-primary rounded-pill btn-sm" style="margin-left: 10px" href="#" role="button">Info</a>--}}
{{--                    <a class="btn btn-outline-primary rounded-pill btn-sm" style="margin-left: 10px" href="#" role="button">Tracking</a>--}}
{{--                </div>--}}
{{--                <!-- Your content here -->--}}
{{--                @php--}}
{{--                    $count = 0;--}}
{{--                @endphp--}}
{{--                <div class="table-responsive-sm">--}}
{{--                    <table class="table mb-0 table-sm table-striped text-nowrap w-100 display">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th class="wd-15p">#</th>--}}
{{--                            <th class="wd-25p">Subject</th>--}}
{{--                            <th class="wd-25p">Print</th>--}}
{{--                            <th class="wd-25p">Reply</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($allDocuments as  $allDocument)--}}
{{--                            @foreach($userDocuments as $document)--}}
{{--                                @if ($allDocument->id == $document)--}}
{{--                                    @php--}}
{{--                                        $doc = \App\Models\Document::dashboardDocumentTitle($document);--}}
{{--                                        $count++;--}}
{{--                                    @endphp--}}
{{--                                    <tr>--}}
{{--                                        <td><span class="">{{ $count }}</span></td>--}}
{{--                                        <td>--}}
{{--                                            <span style="padding-left: 10px" >--}}
{{--                                                <b>--}}
{{--                                                    <a href="{{ route('docShow', $allDocument->id) }}" class="text-primary text-decoration-none">--}}
{{--                                                        {{ ucfirst($doc['subject']) . ' - ' . $doc['docTitle'] }}--}}
{{--                                                    </a>--}}
{{--                                                </b>--}}
{{--                                            </span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <form action="{{ route('printDocument') }}" method="post">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="documentID" value="{{ $allDocument->id }}">--}}
{{--                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>&ensp;Print</button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td>Reply</td>--}}
{{--                                    </tr>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--/ Page layout -->
</div>

@endsection
@section('js')

@endsection
