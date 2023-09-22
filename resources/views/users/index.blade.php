@extends('layouts.nav')
@section('title', 'Users')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Users</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Users
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
            <h4 class="card-title">Add User</h4>
            @can('user_create')
                <a href="{{route('users.create')}}" class="btn btn-primary ml-auto">
                    <i class="fa fa-plus"></i>&ensp;Add User
                </a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table mb-0 table-sm table-striped text-nowrap w-100 display">
                    <thead>
                    <tr>
                        <th class="wd-15p">SrNo.</th>
                        <th class="wd-25p">Name</th>
                        <th class="wd-25p">User Name</th>
                        <th class="wd-25p">User Role</th>
                        <th class="wd-15p">Date Created</th>
                        <th class="wd-25p notExport" style="width: 2%; !important;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>

                                <td>

                                    @foreach($user->roles as $role)
                                        {{ $loop->iteration }} &nbsp;
                                        {{ $role->roleName  }} <br>
                                    @endforeach

                                </td>
                                <td>{{date('d-m-Y', strtotime($user->dateCreated))}}</td>

                                <td>
                                    @php
                                        $crud = 'users';
                                        $row = $user->userID;
                                        $show = 1;
                                        $edit = 1;
                                        $delete = 0;

                                        if($user->userID != 1){
                                            $delete = 1;
                                        }
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
@endsection
