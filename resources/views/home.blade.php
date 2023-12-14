@extends('layouts.nav')
@section('title', 'Dashboard')
@section('main-content')
<div class="content-body opacity">
    <!-- Page layout -->
    <div class="container-fluid">
        <div class="row justify-content-center mb-2">
            @if(\Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Admin' || \Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Clerk')
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="bg-gradient-danger custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='dirRemarks')">
                        <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5" ><span><i class="fa fa-arrow-down"></i></span> Dir-Remarks:  <span class="badge badge-pill bg-secondary">{{$dirRemarks}}</span></div>
                    </div>
                </div>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Admin' || \Illuminate\Support\Facades\Auth::user()->roles[0]->roleName == 'Director')
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-danger custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='notApproved')">
                    <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5" ><span><i class="fa fa-ban"></i></span> Not-Approved:  <span class="badge badge-pill bg-secondary">{{$notApproved}}</span></div>
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
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="bg-gradient-warning custom-col border-black dashboard-widgets text-center changeTextColor-white changeTextColor-black stylish-widget" onclick="widgetFilter(filterData='draft')">
                    <div class="pt-3 pb-3 font-weight-bold shadow-sm font-medium-5" ><span><i class="fa fa-clipboard"></i></span> Draft:  <span class="badge badge-pill bg-secondary">{{$draft}}</span></div>
                </div>
            </div>
        </div>
    </div>


        {{-- Tabs   --}}
    <div class="col-md-12">

        <div class="row d-flex justify-content-left mb-2 d-none" id="filterSearch">
            <div class="col-md-3 col-sm-3 me-5">
                <form method="POST" action="{{ route('home.widgetFilter') }}" id="searchForm">
                    @csrf
                    <label for="">Directorate</label>
                    <input type="hidden" name="filterData" id="filterData" value="">
                    <select name="searchDirectorate" class="form-select" style="width: 100%">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->name }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="mt-1 btn btn-sm btn-primary"><i class="fa fa-search"></i>Search</button>
                </form>
            </div>
        </div>

        <div class="card text-center mb-3">
            <div class="card-header pt-1">
                <div class="accordion-header">
                    <h4 id="widgetName">

                    </h4>
                </div>
                <ul class="nav nav-tabs card-header-tabs d-none" role="tablist" id="receivedBtn">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-new" aria-controls="navs-tab-new" aria-selected="true" onclick="widgetFilter(filterData='unread')">
                            Unread
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-new" aria-controls="navs-tab-new" aria-selected="true" onclick="widgetFilter(filterData='read')">
                            Read (<span id="readCount"></span>)
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
                        <div class="table-responsive">
                            <table class="table-responsive table-sm table-striped text-nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-25p">Subject</th>
                                    <th class="wd-25p">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="allDataBody">
                                @if(!empty($filtered))
                                    @foreach($filtered as $data)
                                        @foreach($data as $rec)
                                        @php
                                            $doc = \App\Models\Document::dashboardDocumentTitle($rec->docuID);
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td><span class="">{{ $count }}</span></td>
                                            <td>
                                            <span style="padding-left: 10px" >
                                                <b>
                                                    <a href="" class="text-primary text-decoration-none" onclick="updateStatus({{$rec->recipientID }}, {{ $rec->status }})">
                                                        {{ $doc['subject']   }} - {{ $doc['docTitle'] }}
                                                    </a>
                                                </b>
                                            </span>
                                            @if($rec->status == 1)
                                                <span style="padding-left: 10px; color: #0e0f12" class="badge">New</span>
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('docShowReceived', $rec->docuID) }}" class="text-primary text-decoration-none" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="archive({{$rec->docuID}})" data-doc-id="{{$rec->docuID}}" style="color: white; padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Archive">
                                                    <i class="fa fa-archive"></i>
                                                </button>

                                            </td>
                                        </tr>
                                      @endforeach
                                    @endforeach
                                @else
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
                                @endif
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
        function sendToSup(documentId) {
            $.ajax({
                url: "{{ route('sendDocToSup') }}",
                method: 'get',
                _token: "{{ csrf_token() }}",
                data: { docID: documentId },
                success: function (response) {
                    location.reload()
                },
                error: function (error) {
                    // Handle error, e.g., show an error message
                    console.error('Error approving document:', error);
                }
            });
        }

        function approve(documentId) {
            $.ajax({
                url: "{{ route('approveDoc') }}",
                method: 'get',
                _token: "{{ csrf_token() }}",
                data: { docID: documentId },
                success: function (response) {
                    location.reload()
                },
                error: function (error) {
                    // Handle error, e.g., show an error message
                    console.error('Error approving document:', error);
                }
            });
        }

        function archive(documentId,filterData) {
            $.ajax({
                url: `{{route('documents.archive')}}`,
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    documentID: documentId,
                    filterData: filterData,
                },
                success: function(response) {
                    widgetFilter(filterData);
                    },
                error: function(error) {
                    console.error('Error archiving document:', error);
                }
            });
        }

        function deleteDoc(documentId) {
            $.ajax({
                url: '/docDelete/' + documentId,
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (response) {
                    location.reload();
                },
                error: function (error) {
                    console.error('Error sending document:', error);
                }
            });
        }

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

        $(function() {
            var typingTimer;
            var doneTypingInterval = 1200;  // Adjust the delay time in milliseconds
            var searchFilter;
            $('#searchFilter').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    searchFilter = $('#searchFilter').val();
                    $.ajax({
                        url: "{{ route('home',"searchFilter") }}",
                        method: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            searchFilter: searchFilter,
                        },
                        success: function(data) {
                            console.log(data)
                        },
                    });
                }, doneTypingInterval);
            });
        });

        function widgetFilter(filterData){

            if (filterData === 'received' || filterData === 'unread' || filterData === 'read' ) {
                $('#receivedBtn').removeClass('d-none');
            } else {
                $('#receivedBtn').addClass('d-none');
            }


            $('#widgetName').html(filterData.toUpperCase());
            var strHTML = '';
            $.ajax({
                url: "{{ route('home.widgetFilter') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    filterData: filterData,
                },
                success: function (data) {

                    if (filterData === 'received' || filterData === 'read' || filterData === 'unread') {
                        var isConditionTrue = true;
                        if (isConditionTrue) {
                            $('#filterData').val(filterData);
                            $('#filterSearch').removeClass('d-none');
                        } else {
                            $('#filterSearch').addClass('d-none');
                        }
                    }else{
                        $('#filterSearch').addClass('d-none');
                    }

                    $('#readCount').html(data.read);
                    if (data.filtered[0] === 'unread'){
                        location.reload();
                    }
                    else {
                        if (data.filtered !== '') {
                            $('#allDataBody tr').hide();
                            data.filtered.forEach(function (value) {
                                value.forEach(function (v){
                                    var createdDate = new Date(v.document_created_at);
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
                                        link = '<a href="{{ route('docShowReceived','') }}/' + v.docuID + '" class="text-primary text-decoration-none" onclick="updateStatus('+v.recipientID+')">' +
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
                                                     ${['dirRemarks','notApproved','received', 'read', 'unread','sent','draft'].includes(filterData) ?
                                                        `<a href="{{ route('docShowNotApprove', '') }}/${v.docuID}" class="btn btn-sm btn-primary" style="padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Show">
                                                            <i class="fa fa-eye"></i>
                                                         </a>` : ''}
                                                     ${['dirRemarks','notApproved','draft'].includes(filterData) ?
                                                        `<a href="{{ route('docEditNotApprove', '') }}/${v.docuID}" class="btn btn-sm btn-info" style="padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>` : ''}
                                                     ${['dirRemarks','notApproved','draft'].includes(filterData) ?
                                                        `<button type="button" class="btn btn-sm btn-danger" onclick="deleteDoc(${v.docuID})" data-doc-id="${v.docuID}" style="color: white; padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>` : ''}
                                                     ${['notApproved'].includes(filterData) ?
                                                        `<button type="button" class="btn btn-sm btn-success" onclick="approve(${v.docuID})" data-doc-id="${v.docuID}" style="color: white; padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Approve">
                                                            <i class="fa fa-check"></i>
                                                        </button>` : ''}
                                                     ${['dirRemarks','draft'].includes(filterData) ?
                                                        `<button type="button" class="btn btn-sm btn-success" onclick="sendToSup(${v.docuID})" data-doc-id="${v.docuID}" style="color: white; padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Send To Superior">
                                                            <i class="fa fa-send"></i>
                                                         </button>` : ''}
                                                     ${['dirRemarks','notApproved','received', 'read', 'unread','sent','draft'].includes(filterData) ?
                                                        `<button type="button" class="btn btn-sm btn-warning" onclick="archive(${v.docuID},filterData)" data-doc-id="${v.docuID}" style="color: white; padding: 4px; margin-right: 5px" data-toggle="tooltip" title="Archive">
                                                            <i class="fa fa-archive"></i>
                                                         </button>` : ''}

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
    </script>
@endsection
