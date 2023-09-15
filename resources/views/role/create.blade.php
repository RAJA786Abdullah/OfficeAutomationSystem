@extends('layouts.nav')
@section('app-content', 'app-content')
@section('title', 'New Role')

@section('main-content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">New Role</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a>
                            </li>
                            <li class="breadcrumb-item active">New Role
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i data-feather="user-plus"></i> New Role
            </h3>
        </div>
        <div class="card-body">
			<form class="form-horizontal" action="{{ route('role.store') }}" method="POST">
				@csrf
                <div class="form-group mb-2 row {{ $errors->has('roleName') ? 'has-error' : '' }}">
                    <label for="roleName" class="col-sm-2 required form-label">Role Name:</label>
					<div class="col-sm-10">
	                    <input type="text" name="roleName" class="form-control @if($errors->has('roleName')) is-invalid @endif" value="{{ old('roleName') }}">
	                    @if($errors->has('roleName'))
	                        <em class="invalid-feedback">
	                            {{ $errors->first('roleName') }}
	                        </em>
	                    @endif
					</div>
                </div>
				<div class="form-group row mb-2">
                    <label for="description" class="col-sm-2 form-label">Description: </label>
					<div class="col-sm-10">
                    	<textarea name="description" class="form-control">{{ old('description') }}</textarea>
					</div>
                </div>
				<div class="form-group row">
					<div class="col-sm-12">
						<table class="table" @if($errors->has('privilegeID')) style="border:1px solid red;" @endif>
							<thead>
								<tr>
									<th>Modules</th>
									<th colspan="4">Privileges</th>
								</tr>
							</thead>
							<tbody>
                            <tr>
								@php
									$moduleID = 0;
								@endphp
								@foreach($privileges as $privilege)
									@php
                                       if ($moduleID != $privilege->moduleID) {
											if ($moduleID != 0) {
												echo '</tr>';
											}
											echo '<tr><td><label>' . $privilege->modules->moduleName . '</label></td>';
											$moduleID = $privilege->moduleID;
										}
									@endphp
									<td>
										<label class="form-check-label">
											<input type="checkbox" name="privilegeID[]" value="{{ $privilege->privilegeID }}" @if($errors->has('privilegeID')) is-invalid @endif
												{{ (is_array(old('privilegeID')) && in_array($privilege->privilegeID, old('privilegeID'))) ? ' checked' : '' }}
											/>
											&nbsp;&nbsp;{{ $privilege->privilegeName }}
										</label>
									</td>
								@endforeach
								</tr>
							</tbody>
						</table>
						@if($errors->has('privilegeID'))
							<em class="text-danger">
								{{ $errors->first('privilegeID') }}
							</em>
						@endif
					</div>
				</div>
                <div class="row mt-2">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop
