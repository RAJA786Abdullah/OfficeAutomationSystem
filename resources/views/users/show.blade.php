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
                        <td><strong>Name :</strong> {{ $user->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Arm Designation :</strong> {{ $user->arm_designation}}</td>
                    </tr>
                    <tr>
                        <td><strong>User Name :</strong> {{ $user->email }} </td>
                    </tr>
                </tbody>
                <tbody class="col-lg-6 p-0">
                    <tr>
                        <td><strong>Branch :</strong> {{ $user->branch->name  }}</td>
                    </tr>
                    <tr>
                        <td><strong>Department :</strong> {{ $user->department->name  }}</td>
                    </tr>

                </tbody>
                <tbody class="col-lg-6 p-0">
                    <tr>
                        <td><strong>Singing Authority :</strong> {{ $user->is_signing_authority == 1 ? "Yes" : "No"  }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status :</strong> {{ $user->status == 1 ? "Active" : "Not Active"  }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date Created :</strong> {{date('d M Y', strtotime($user->created_at)) }}</td>
                    </tr>
                </tbody>

                <tbody class="col-lg-6 p-0">
                    <tr>
                        <td><strong>Is Singing Authority :</strong> {{ $user->is_signing_authority == 1 ? "Yes" : "No"  }}</td>
                    </tr>
                </tbody>



            </table>
        </div>
    </div>
    <!--/ Page layout -->
</div>
@endsection
