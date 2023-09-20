@extends('layouts.nav')
@section('title', 'User Show')
@section('app-content', 'app-content')

@section('main-content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">User</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">User
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
            <h3 class="mb-0 card-title"><i class="fa fa-user"></i> {{ $user->name }}</h3>
            @can('user_update')
                <a href="{{route('users.edit',$user->userID)}}" class="btn btn-primary ml-auto">
                    <i class="fa fa-plus"></i>&ensp;Edit User
                </a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table-sm table-striped text-nowrap w-100 display">
                <tbody class="col-lg-6 p-0">
                <tr>
                    <td><strong>User Name :</strong> {{ $user->name}}</td>
                </tr>
                <tr>
                    <td><strong>Email :</strong> <a href="mailto:{{ $user->email}}">{{ $user->email}}</a></td>
                </tr>
                </tbody>
                <tbody class="col-lg-6 p-0">
                <tr>
                    <td><strong>User Type :</strong> {{ $user->userType->userType}}</td>
                </tr>
                <tr>
                    <td><strong>Date Created :</strong> {{ $user->dateCreated}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Page layout -->
</div>
@endsection
