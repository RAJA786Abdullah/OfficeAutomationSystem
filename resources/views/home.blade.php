@extends('layouts.nav')
@section('title', 'Dashboard')
@section('main-content')
<div class="content-body opacity">
    <!-- Page layout -->
    <div class="container-fluid">
        <div class="row justify-content-center mb-2">
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-info custom-col shadow-bottom border-1 dashboard-widgets text-center">
                    <div class="pt-3 pb-3 font-weight-bold font-medium-5" ><span><i class="fa fa-envelope"></i></span> Unread: {{$notApprovedDocs}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-danger custom-col shadow-bottom border-1 dashboard-widgets text-center">
                    <div class="pt-3 pb-3 font-weight-bold font-medium-5" ><span><i class="fa fa-ban"></i></span> Not Approved: {{$notApprovedDocs}}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-primary custom-col shadow-bottom border-1 dashboard-widgets text-center">
                    <div class="pt-3 pb-3 font-weight-bold font-medium-5" ><span><i class="fa fa-get-pocket"></i></span> Received: {{ $received }}</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-success custom-col shadow-bottom border-1 dashboard-widgets text-center">
                    <div class="pt-3 pb-3 font-weight-bold font-medium-5" ><span><i class="fa fa-paper-plane"></i></span> Sent: {{$sent}}</div>
                </div>
            </div>
        </div>
    </div>


        {{-- Tabs   --}}
    <div class="col-md-12">
        <div class="card text-center mb-3">
            <div class="card-header pt-1">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-new" aria-controls="navs-tab-new" aria-selected="true">
                            Inbox
                        </button>
                    </li>
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-sent" aria-controls="navs-tab-sent" aria-selected="false" tabindex="-1">--}}
{{--                            Sent--}}
{{--                        </button>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-received" aria-controls="navs-tab-received" aria-selected="false" tabindex="-2">--}}
{{--                            Received--}}
{{--                        </button>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane fade active show" id="navs-tab-new" role="tabpanel">
                        <!-- Your content here -->
                        @php
                            $count = 0;
                        @endphp
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-striped text-nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-25p">Subject</th>
                                    <th class="wd-25p">Print</th>
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
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-tab-sent" role="tabpanel">
                        <!-- Your content here -->

                    </div>
                    <div class="tab-pane fade" id="navs-tab-received" role="tabpanel">
                        <!-- Your content here -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

@endsection
