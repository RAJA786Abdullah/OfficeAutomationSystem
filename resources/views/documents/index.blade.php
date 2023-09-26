@extends('layouts.nav')
@section('title', 'Documents')
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
            @can('user_create')
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
                                <td>{{$document->classification->name}}</td>
                                <td>{{$document->file->name}}</td>
                                <td>{{$document->subject}}</td>
                                <td>{{$document->user->name}}</td>

                                <td>
                                    @php
                                        $crud = 'documents';
                                        $row = $document->id;
                                        $show = 1;
                                        $edit = 1;
                                        $delete = 1;
                                    @endphp
                                    @include('partials.actions')
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
@section('more-script')
    @include('partials.shortcutKeyCreate')
    <script>
        function sweetAlertCall(trElem){
            var tr = $(trElem).closest('tr');
            var promise = swal({
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
                        swal("Your data is safe!");
                    }
                });
        }
    </script>
@endsection
