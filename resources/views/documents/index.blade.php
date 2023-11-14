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
                    <table class="table-responsive table mb-0 table-sm table-striped text-nowrap w-100 display">
                        <thead>
                        <tr>
                            <th class="wd-15p">Document No</th>
                            <th class="wd-25p">Classification</th>
                            <th class="wd-25p">File No</th>
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
                                    <td>{{ \App\Models\Document::documentTitle($document->id) }}</td>
                                    <td>{{ $document->classification->name }}</td>
                                    <td>{{ $document->file->name }} | {{ $document->file->code }}</td>
                                    <td>{{ $document->subject }}</td>
                                    <td>{{ $document->user->name }}</td>
                                    <td>
                                        @if ($canShow)
                                            <a href="{{ route($crud . '.show', $row) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Show">
                                                <i data-feather="eye"></i>
                                            </a>
                                        @endif
                                        @if ($canEdit)
                                            <a href="{{ route($crud . '.edit', $row) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit">
                                                <i data-feather="edit"></i>
                                            </a>
                                        @endif
                                        @if ($canDelete)
                                            <form action="{{ route($crud . '.destroy', $row) }}" method="POST" class="deleteForm" style="display: inline-block;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger" onclick="sweetAlertCall(this)" data-toggle="tooltip" title="Delete" style="color: white;">
                                                    <i data-feather="trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($canSend)
                                            <form action="{{ route('sendDocToSup', $document->id) }}" method="GET" style="display: inline-block" class="sendDoc">
                                                @csrf
                                                <input type="hidden" name="docID" value="{{ $document->id }}">
                                                <button type="button" class="btn btn-sm btn-success" onclick="sendDocAlert()" data-toggle="tooltip" title="Send" style="color: white;">
                                                    <i data-feather="send"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($canApprove)
                                            <form action="{{ route('approveDoc', $document->id) }}" method="GET" style="display: inline-block" class="approveDoc">
                                                @csrf
                                                <input type="hidden" name="docID" value="{{ $document->id }}">
                                                <button type="button" class="btn btn-sm btn-success" onclick="approveDocAlert()" data-toggle="tooltip" title="Approve" style="color: white;">
                                                    <i data-feather="check"></i>
                                                </button>
                                            </form>
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
