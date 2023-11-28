@extends('layouts.nav')
@section('title', 'Dashboard')
@section('main-content')
<div class="content-body opacity">
    <!-- Page layout -->
    <div class="container-fluid">
        <div class="row justify-content-center mb-2">
{{--            <div class="col-md-3 col-sm-6 mb-2">--}}
{{--                <div class="bg-gradient-info custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='unread')">--}}
{{--                    <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5"><span><i class="fa fa-envelope"></i></span> Unread:  <span class="badge badge-pill bg-secondary">{{$unread}}</span></div>--}}
{{--                </div>--}}
{{--            </div>--}}
            @if(\Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Admin' || \Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Director')
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-danger custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='notApproved')">
                    <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5" ><span><i class="fa fa-ban"></i></span> Not Approved:  <span class="badge badge-pill bg-secondary">{{$notApproved}}</span></div>
                </div>
            </div>
            @endif
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-primary custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='received')">
                    <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5" ><span><i class="fa fa-get-pocket"></i></span> Received:  <span class="badge badge-pill bg-secondary">{{$received}}</span></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-success custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='sent')">
                    <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5" ><span><i class="fa fa-paper-plane"></i></span> Sent:  <span class="badge badge-pill bg-secondary">{{$sent}}</span></div>
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Admin' || \Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Clerk')
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-warning custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='draft')">
                    <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5" ><span><i class="fa fa-clipboard"></i></span> Draft:  <span class="badge badge-pill bg-secondary">{{$draft}}</span></div>
                </div>
            </div>
            @endif
        </div>
    </div>


        {{-- Tabs   --}}
    <div class="col-md-12">
        <div class="card text-center mb-3">
            <div class="card-header pt-1">
                <ul class="nav nav-tabs card-header-tabs d-none" role="tablist" id="receivedBtn">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-new" aria-controls="navs-tab-new" aria-selected="true" onclick="widgetFilter(filterData='unread')">
                            Unread
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-new" aria-controls="navs-tab-new" aria-selected="true" onclick="widgetFilter(filterData='read')">
                            Read
                        </button>
                    </li>
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
                            <table class=" table-sm table-striped text-nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-25p">Subject</th>
                                    <th class="wd-25p">Print</th>
                                </tr>
                                </thead>
                                <tbody id="allDataBody">
                                @foreach($unreadDocs as $unreadDoc)
                                    @php
                                        $doc = \App\Models\Document::dashboardDocumentTitle($unreadDoc->id);
                                        $count++;
                                    @endphp
                                    <tr>

                                    <td><span class="">{{ $count }}</span></td>
                                    <td>
                                        <span style="padding-left: 10px" >
                                            <b>
{{--                                                <a href="{{ route('docShow', $unreadDoc->id) }}" class="text-primary text-decoration-none" onclick="updateStatus({{$unreadDoc->recipientID }}, {{ $unreadDoc->status }})">--}}
                                                <a href="" class="text-primary text-decoration-none" onclick="updateStatus({{$unreadDoc->recipientID }}, {{ $unreadDoc->status }})">
                                                    {{ $doc['subject']   }} - {{ $doc['docTitle'] }}
                                                </a>
                                            </b>
                                        </span>
                                        @if($unreadDoc->status == 1)
                                            <span style="padding-left: 10px; color: #0e0f12" class="badge">New</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <form action="{{ route('printDocument') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="documentID" value="{{ $unreadDoc->id }}">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>&ensp;Print</button>
                                            </form>
                                        </div>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script>

        function updateStatus(recipientID,status) {

            $.ajax({
            url: "{{ route('ajax.handle',"updateRecipientStatus") }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                recipientID: recipientID,
                status: status,
            },
            success: function(data) {
            },
            });
        }

        function widgetFilter(filterData){
            if (filterData === 'received' || filterData === 'unread' || filterData === 'read' ) {
                $('#receivedBtn').removeClass('d-none');
            } else {
                $('#receivedBtn').addClass('d-none');
            }
            var strHTML = '';
            $.ajax({
                url: "{{ route('home.widgetFilter') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    filterData: filterData,
                },
                success: function (data) {
                    if (data.filtered[0] === 'unread'){
                        location.reload();
                    }
                    else {
                        if (data.filtered !== '') {
                            $('#allDataBody tr').hide();
                            data.filtered.forEach(function (value) {
                                value.forEach(function (v){
                                    var createdDate = new Date(v.created_at);
                                    var formattedDate = createdDate.toLocaleDateString('en-US', {
                                        day: 'numeric',
                                        month: 'short',
                                        year: 'numeric'
                                    });
                                    var link;

                                    if (filterData === 'notApproved') {
                                        // Customize the link structure for notApproved
                                        link = '<a href="{{ route('docShowNotApprove','') }}/' + v.docuID + '" class="text-primary text-decoration-none" onclick="updateStatus('+v.recpID+')">' +
                                            v.subject + ' - ' + v.docCode + '/' + v.fileCode + '/' + v.uniqueID + '/' + v.depName + ' dated ' + formattedDate +
                                            '</a>';
                                    }else if (filterData === 'received' || filterData === 'read' || filterData === 'unread') {
                                        // Customize the link structure for notApproved
                                        link = '<a href="{{ route('docShowReceived','') }}/' + v.docuID + '" class="text-primary text-decoration-none" onclick="updateStatus('+v.recpID+')">' +
                                            v.subject + ' - ' + v.docCode + '/' + v.fileCode + '/' + v.uniqueID + '/' + v.depName + ' dated ' + formattedDate +
                                            '</a>';
                                    }
                                    else {
                                        // Default link structure
                                        link = '<a href="{{ route('docShow', '') }}/' + v.docuID + '" class="text-primary text-decoration-none" onclick="updateStatus('+v.recpID+')">' +
                                            v.subject + ' - ' + v.docCode + '/' + v.fileCode + '/' + v.uniqueID + '/' + v.depName + ' dated ' + formattedDate +
                                            '</a>';
                                    }
                                    strHTML += `<tr>
                                                <td>${v.docuID}</td>
                                                <td>
                                                    <input type="hidden">
                                                    <span style="padding-left: 10px">
                                                        <b>${link}</b>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('docShowNotApprove', '') }}/${v.docuID}" class="btn btn-sm btn-primary" style="padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Show">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('docEditNotApprove', '') }}/${v.docuID}" class="btn btn-sm btn-info" style="padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger del-doc-btn" data-doc-id="${v.docuID}" style="color: white; padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-success aprv-doc-btn" data-doc-id="${v.docuID}" style="color: white; padding: 4px" data-toggle="tooltip" title="Approve">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>`;

                                });
                            });
                            $('#allDataBody').append(strHTML);
                        }
                    }
                },
            });
        }

        {{--$(document).ready(function () {--}}
        {{--    $('.show-doc-btn').on('click', function () {--}}
        {{--        var docId = $(this).data('doc-id');--}}

        {{--        $.ajax({--}}
        {{--            url: "{{ route('documentShow') }}",--}}
        {{--            method: 'get',--}}
        {{--            _token: "{{ csrf_token() }}",--}}
        {{--            data: { docID: docId },--}}
        {{--            success: function (response) {--}}
        {{--                location.reload()--}}
        {{--            },--}}
        {{--            error: function (error) {--}}
        {{--                console.error('Error sending document:', error);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection

{{--'<a href="{{ route('documents.show', $row) }}" class="btn btn-sm btn-primary" style="padding: 4px" data-toggle="tooltip" title="Show">'+--}}
{{--    '<i data-feather="eye"></i>'+--}}
{{--'</a>'+--}}


{{--'<button type="button" class="btn btn-sm btn-success send-doc-btn" data-doc-id="' + v.docuID +'" data-toggle="tooltip" title="Show" style="color: white; padding: 4px">'+--}}
{{--    '<i data-feather="eye"></i>'+--}}
{{--'</button>'+--}}




{{--'<td>' +--}}
{{--    '<div class="d-flex justify-content-between">' +--}}
{{--        // Approve button--}}
{{--        '<button type="button" class="btn btn-sm btn-success approve-doc-btn" data-doc-id="' + v.docuID + '" data-toggle="tooltip" title="Approve" style="color: white; padding: 4px">' +--}}
{{--            '<i data-feather="check"></i>' +--}}
{{--            '</button>' +--}}
{{--        // Send button--}}
{{--        '<button type="button" class="btn btn-sm btn-success send-doc-btn" data-doc-id="' + v.docuID + '" data-toggle="tooltip" title="Send" style="color: white; padding: 4px">' +--}}
{{--            '<i data-feather="send"></i>' +--}}
{{--            '</button>' +--}}
{{--        '</div>' +--}}
{{--    '</td>' +--}}



{{--'<form action="{{ route('printDocument') }}" method="post">' +--}}
{{--    '@csrf' +--}}
{{--    '<input type="hidden" name="documentID" value="' + v.docuID + '">' +--}}
{{--    '<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>&ensp;Print</button>' +--}}
{{--    '</form>' +--}}
