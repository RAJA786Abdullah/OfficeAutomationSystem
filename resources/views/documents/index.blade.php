@extends('layouts.nav')
@section('title', 'Documents Index')
@section('app-content', 'app-content')

@section('main-content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Documents</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Documents
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
            <div class="card-header">
                <h4 class="card-title">Add Document</h4>
                @can('documents_create')
                    <a href="{{route('documents.create')}}" class="btn btn-primary ml-auto">
                        <i class="fa fa-plus"></i>&ensp;Add Document
                    </a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped text-nowrap w-100 display">
                        <thead>
                        <tr>
                            <th class="wd-15p">Date</th>
                            <th class="wd-25p">File No</th>
                            <th class="wd-15p">Document No</th>
                            <th class="wd-25p">SecurityCl</th>
                            <th class="wd-25p">subject</th>
                            <th class="wd-25p">Created By</th>
                            <th class="wd-25p notExport" style="width: 2%; !important;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($documents as $document)

                            @php
                                $crud = 'documents';
                                $row = $document->id;
                                $user = \Illuminate\Support\Facades\Auth::user();
                                $userID = \Illuminate\Support\Facades\Auth::id();
                                $userRole = $user->roles[0]->roleName;

                                $canShow = false;
                                $canEdit = false;
                                $canDelete = false;
                                $canSend = false;
                                $canApprove = false;
                                $isRow = false;

                                if (strpos($userRole, "Admin") !== false) {
                                    // User has admin role, so they can do everything.
                                    $canShow = $canEdit = $canDelete = $canSend = $canApprove = $isRow = true;
                                } else {
                                    if ($document['is_draft'] == 1 && $document['created_by'] == $userID) {
                                        // Document is a draft, and the current user created it, so they can perform specific actions.
                                        $canShow = $canEdit = $canDelete = $canSend = $isRow = true;
                                    } elseif ($document['is_draft'] == 0) {
                                        // Document is not a draft.
                                        if ($userID == $document['in_dept'] && $document['out_dept'] == '') {
                                            // User is in the same department, and there's no outgoing department set.
                                            if ($document['signing_authority_id'] == $userID) {
                                                // User has signing authority, so they can approve the document.
                                                $canShow = $canEdit = $canDelete  = $canApprove = $isRow = true;
                                            } else {
                                                // User can edit, delete, and send the document.
                                                $canShow = $canEdit = $canDelete  = $canSend = $isRow = true;
                                            }
                                        } else {
                                            // User is not in the same department or there is an outgoing department, so they can only view the document.
                                            $canShow = $isRow = true;
                                        }
                                    } elseif ($document['out_dept'] != '') {
                                        // There is an outgoing department, so the user can only view the document.
                                        $canShow = $isRow = true;
                                    }
                                }

                            @endphp
                            @if($isRow)
                                <tr>
                                    <td> {{ $document->id }} {{date(" d-m-Y", strtotime($document->created_at))}}</td>
                                    <td>{{ $document->file->name }} | {{ $document->file->code }}</td>
                                    <td>{{ \App\Models\Document::documentTitle($document->id) }}</td>
                                    <td>{{ $document->classification->name }}</td>
                                    <td>{{ $document->subject }}</td>
                                    <td>{{ $document->user->name }}</td>
                                    <td style="padding: 0; margin: 0">
                                        @if ($canShow)
                                            <a href="{{ route($crud . '.show', $row) }}" class="btn btn-sm btn-primary" style="padding: 4px" data-toggle="tooltip" title="Show">
                                                <i data-feather="eye"></i>
                                            </a>
                                        @endif
                                        @if ($canEdit)
                                            <a href="{{ route($crud . '.edit', $row) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit" style="padding: 4px">
                                                <i data-feather="edit"></i>
                                            </a>
                                        @endif
                                        @if ($canDelete)
                                            <button type="button" class="btn btn-sm btn-danger delete-doc-btn" data-doc-id="{{ $document->id }}" data-toggle="tooltip" title="Delete" style="color: white; padding: 4px">
                                                <i data-feather="trash"></i>
                                            </button>
                                        @endif
                                        @if ($canSend)
                                            <button type="button" class="btn btn-sm btn-success send-doc-btn" data-doc-id="{{ $document->id }}" data-toggle="tooltip" title="Send" style="color: white; padding: 4px">
                                                <i data-feather="send"></i>
                                            </button>
                                        @endif
                                        @if ($canApprove)
                                            <button type="button" class="btn btn-sm btn-success approve-doc-btn" data-doc-id="{{ $document->id }}" data-toggle="tooltip" title="Approve" style="color: white; padding: 4px">
                                                <i data-feather="check"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-wrapper -->
            </div>
        </div>
        <!--/ Page layout -->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.delete-doc-btn').on('click', function () {
                var docId = $(this).data('doc-id');

                $.ajax({
                    url: '/docDelete/' + docId,
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
            });
            $('.send-doc-btn').on('click', function () {
                var docId = $(this).data('doc-id');

                $.ajax({
                    url: "{{ route('sendDocToSup') }}",
                    method: 'get',
                    _token: "{{ csrf_token() }}",
                    data: { docID: docId },
                    success: function (response) {
                        location.reload()
                    },
                    error: function (error) {
                        console.error('Error sending document:', error);
                    }
                });
            });
            $('.approve-doc-btn').on('click', function () {
                var docId = $(this).data('doc-id');

                $.ajax({
                    url: "{{ route('approveDoc') }}",
                    method: 'get',
                    _token: "{{ csrf_token() }}",
                    data: { docID: docId },
                    success: function (response) {
                        location.reload()
                    },
                    error: function (error) {
                        // Handle error, e.g., show an error message
                        console.error('Error approving document:', error);
                    }
                });
            });
        });
        function sweetAlertCall(trElem) {
            var tr = $(trElem).closest('tr');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your data has been deleted!", {
                            icon: "success",
                        });
                        tr.find('.deleteForm').submit();
                    } else {
                        swal({
                            title:"Your data is safe!",
                            buttons: true,
                            confirmButtonText: 'shukria',
                            confirmButton: true,
                            confirmButtonColor: '#7367f0'
                        });
                    }
                });
        }
        function sendDocAlert() {
            swal({
                title: "Are you sure?",
                text: "Once you send the Document, you will be unable to edit or delete the document!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willSend) => {
                    if (willSend) {
                        swal("Document sent successfully!", {
                            icon: "success",
                        });
                        $('.sendDoc').submit();
                    } else {
                        swal({
                            title: "You can update your document!",
                            buttons: true,
                            confirmButtonText: 'shukria',
                            confirmButton: true,
                            confirmButtonColor: '#7367f0'
                        });
                    }
                });
        }
        function approveDocAlert() {
            swal({
                title: "Are you sure?",
                text: "Once you approve the Document, you will not be able to edit or delete the document!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willSend) => {
                    if (willSend) {
                        swal("Document approved successfully!", {
                            icon: "success",
                        });

                        // Find and submit the form with class 'sendDoc'
                        $('.approveDoc').submit();
                    } else {
                        swal({
                            title: "You can update your document!",
                            buttons: true,
                            confirmButtonText: 'shukria',
                            confirmButton: true,
                            confirmButtonColor: '#7367f0'
                        });
                    }
                });
        }
    </script>
@endsection
