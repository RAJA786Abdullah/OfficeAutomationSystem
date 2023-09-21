@extends('layouts.nav')
@section('title', 'Attachments')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Attachments</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Attachments
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
            <h4 class="card-title">Add Attachment</h4>
            @can('user_create')
                <a href="{{route('attachments.create')}}" class="btn btn-primary ml-auto">
                    <i class="fa fa-plus"></i>&ensp;Add Attachment
                </a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table mb-0 table-sm table-striped text-nowrap w-100 display">
                    <thead>
                    <tr>
                        <th class="wd-15p">SrNo.</th>
                        <th class="wd-25p">Document</th>
                        <th class="wd-25p">Attachment Type</th>
                        <th class="wd-15p">Date Created</th>
                        <th class="wd-25p notExport" style="width: 2%; !important;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($attachments as $attachment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{\App\Models\Document::documentTitle($attachment->document_id)}}</td>
                                <td>{{$attachment->name}}</td>
                                <td>{{$attachment->type}}</td>
                                <td>{{date('d-m-Y', strtotime($attachment->created_at))}}</td>
                                <td>
                                    @php
                                        $crud = 'attachments';
                                        $row = $attachment->id;
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
@section('js')
    @include('partials.shortcutKeyCreate')
@endsection
