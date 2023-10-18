@extends('layouts.nav')
@section('app-content', 'app-content')
@section('title', 'Audit')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
{{--                        <li class="breadcrumb-item"><a href="{{route('role.index')}}">Audit</a></li>--}}
                        <li class="breadcrumb-item active">Audit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title d-inline-block">
                <i class="ti ti-history"></i> Audit
            </h3>
            <div class="card-actions d-inline-block float-end">
                @can('roles_update')
{{--                    <a class="btn btn-primary btn-sm " href="{{ route("role.edit",$role->roleID) }}">--}}
{{--                        <i class="fas fa-edit"></i> Edit Audit--}}
{{--                    </a>--}}
                @endcan
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table mb-0 table-sm table-striped text-nowrap w-100 display" style="border: 1px solid black;">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Model</th>
                    <th scope="col">Ip Address</th>
                    <th scope="col">URL</th>
                    <th scope="col">Action</th>
                    <th scope="col">User</th>
                    <th scope="col">Time</th>
                    <th scope="col">Old Values</th>
                    <th scope="col">New Values</th>
                </tr>
                </thead>
                <tbody id="audits">
                @foreach($audits as $audit)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
                        <td>{{ $audit->ip_address }}</td>
                        <td>{{ $audit->url }}</td>
                        <td>{{ $audit->event }}</td>
                        <td>{{ $audit->user->name }}</td>
                        <td>{{ $audit->created_at }}</td>
                        <td>
                            <table class="table">
                                @foreach($audit->old_values as $attribute => $value)
                                    <tr>
                                        <td><b>{{ $attribute }}</b></td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td>
                            <table class="table">
                                @foreach($audit->new_values as $attribute => $value)
                                    <tr>
                                        <td><b>{{ $attribute }}</b></td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
