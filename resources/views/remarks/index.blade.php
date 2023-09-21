@extends('layouts.nav')
@section('title', 'Remarks')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Remarks</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Remarks
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
            <h4 class="card-title">Add Remark</h4>
            @can('user_create')
                <a href="{{route('users.create')}}" class="btn btn-primary ml-auto">
                    <i class="fa fa-plus"></i>&ensp;Add Remark
                </a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table mb-0 table-sm table-striped text-nowrap w-100 display">
                    <thead>
                    <tr>
                        <th class="wd-15p">SrNo.</th>
                        <th class="wd-25p">Remark</th>
                        <th class="wd-25p">Recommendation</th>
                        <th class="wd-25p">User</th>
                        <th class="wd-25p">Document</th>
                        <th class="wd-15p">Date Created</th>
                        <th class="wd-25p notExport" style="width: 2%; !important;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($remarks as $remark)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$remark->remark}}</td>
                            <td>{{$remark->recommendation}}</td>
                            <td>{{$remark->user->name}}</td>
                            <td>{{\App\Models\Document::documentTitle($remark->document_id)}}</td>
                            <td>{{date('d-m-Y', strtotime($remark->created_at))}}</td>
                            <td>
                                @php
                                    $crud = 'remarks';
                                    $row = $remark->id;
                                    $show = 0;
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
