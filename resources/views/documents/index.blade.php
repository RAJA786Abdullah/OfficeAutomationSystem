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
            <div class="table-responsive-sm">
                <table class="table mb-0 table-sm table-striped text-nowrap w-100 display">
                    <thead>
                    <tr>
                        <th class="wd-15p">Reference No</th>
{{--                        <th class="wd-15p">Department</th>--}}
                        <th class="wd-25p">Classification</th>
                        <th class="wd-25p">File No</th>
                        <th class="wd-25p">subject</th>
                        <th class="wd-25p">Created By</th>

                        <th class="wd-25p notExport" style="width: 2%; !important;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $document)
                            <tr>
                                <td>{{$document->reference_id}}</td>
{{--                                <td>{{$document->department->name}}</td>--}}
                                <td>{{$document->classification->name}}</td>
                                <td>{{$document->file->name}}</td>
                                <td>{{$document->subject}}</td>
                                <td>{{$document->user->name}}</td>

                                <td>



                                    @php
                                        $crud = 'documents';
                                        $row = $document->id;
                                        $show = 0;
                                        $edit = 0;
                                        $delete = 0;
                                        $send = 0;
                                        $approve = 0;
                                        $user = \Illuminate\Support\Facades\Auth::user()->roles[0]->roleName;
                                        if (strpos($user, "Director") !== false) {
                                              if ($document->signing_authority_id == $document->in_dept)
                                            {
                                                $show = 1;
                                                $edit = 1;
                                                $delete = 1;
                                                $approve = 1;
                                            }
                                            else{
                                                $show = 1;
                                            }
                                        }
                                        elseif (strpos($user, "Clerk") !== false) {
                                            if ($document->created_by == $document->in_dept)
                                            {
                                                $show = 1;
                                                $edit = 1;
                                                $delete = 1;
                                                $send = 1;
                                            }
                                            else{
                                                $show = 1;
                                            }
                                        }


                                    @endphp
                                    @if($show == 1)
                                        <a href="{{ route($crud . '.show', $row) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Show"><i data-feather="eye"></i></a>
                                    @endif
                                    @if($edit == 1)
                                        <a href="{{ route($crud . '.edit', $row) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i data-feather="edit"></i></a>
                                    @endif
                                    @if($delete == 1)
                                        {{--    onsubmit="return confirm(' ! WARNING ! If you Press OK it can not be recovered?');"--}}
                                        <form action="{{ route($crud . '.destroy', $row) }}" method="POST" class="deleteForm" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="button" class="btn btn-sm btn-danger" onclick="sweetAlertCall(this)" data-toggle="tooltip" title="Delete" style="color:white;">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($send == 1)
                                        <form action="{{ route('sendDocToSup',$document->id ) }}" method="POST" style="display: inline-block;" class="sendDoc">
                                            @method('GET')
                                            @csrf
                                            <input type="hidden" name="docID" value="{{ $document->id }}">
                                            <button type="button" class="btn btn-sm btn-success" onclick="sendDocAlert()" data-toggle="tooltip" title="Send" style="color:white;">
                                                <i data-feather="send"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if($approve == 1)
                                        <form action="{{ route('sendDocToSup',$document->id ) }}" method="POST" style="display: inline-block;" class="sendDoc">
                                            @method('GET')
                                            @csrf
                                            <input type="hidden" name="docID" value="{{ $document->id }}">
                                            <button type="button" class="btn btn-sm btn-success" onclick="sendDocAlert()" data-toggle="tooltip" title="Approve" style="color:white;">
                                                <i data-feather="check"></i>
                                            </button>
                                        </form>
                                    @endif

                                        {{--                                    <a href="{{ route('sendDocToSup') }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Send"><i data-feather="send"></i></a>--}}

                                </td>
                            </tr>
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

                        // Find and submit the form with class 'sendDoc'
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

    </script>
@endsection

