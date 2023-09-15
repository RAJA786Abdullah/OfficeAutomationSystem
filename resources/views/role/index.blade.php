@extends('layouts.nav')
@section('app-content', 'app-content')
@section('title', 'Roles')

@section('main-content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Roles</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
{{--                            <li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a>--}}
{{--                            </li>--}}
                            <li class="breadcrumb-item active">Roles
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            @include('partials.message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title d-inline-block">
                        <i data-feather="user-plus"></i> Roles
                    </h3>
                    <div class="card-actions d-inline-block float-end">
                        @can('roles_create')
                            <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">
                                <i data-feather="plus"></i> Add Role
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table class="datatable-role table table-bordered table-striped table-hover ajaxTable datatable">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <!-- <th>Description</th> -->
                            <th>Privileges</th>
                            <!-- <th>Date Created</th> -->
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@section('js')

<script>
    $(function () {
        let dtOverrideGlobals = {
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('role.index') }}",
            columns: [
                { data: 'roleName', name: 'roleName' },
                // { data: 'description', name: 'description' },
                { data: 'privileges', name: 'privileges' },
                // { data: 'dateCreated', name: 'dateCreated' },
                { data: 'actions', name: 'Actions' }
            ],
            order: [[ 0, 'desc' ]],
            pageLength: 100,
        };

        $('.datatable-role').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@stop
