@extends('layouts.nav')
@section('title', 'Edit Role')
@section('app-content', 'app-content')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('role.index')}}">Role</a></li>
                        <li class="breadcrumb-item active">Edit Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
	<div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-tag"></i> Edit Role
            </h3>
        </div>
        <div class="card-body">
			<form class="form-horizontal" action="{{ route('role.update',$role->roleID) }}" method="POST">
				@csrf
				@method('PUT')
                <div class="form-group mb-2 row {{ $errors->has('roleName') ? 'has-error' : '' }}">
                    <label for="roleName" class="col-sm-2 required form-label">Role Name:</label>
					<div class="col-sm-10">
	                    <input type="text" name="roleName" class="form-control @if($errors->has('roleName')) is-invalid @endif" value="{{ old('roleName',$role->roleName) }}">
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
                    	<textarea name="description" class="form-control">{{ old('description',$role->description) }}</textarea>
					</div>
                </div>
				<div class="form-group row">
					<div class="col-sm-12">
						<table class="table" @if($errors->has('privilegeID')) style="border:1px solid red;" @endif>
							<thead>
								<tr>
									<th>Modules</th>
									<th colspan="4">Privilege</th>
								</tr>
							</thead>
							<tbody>
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
											<input type="checkbox" name="privilegeID[]" value="{{ $privilege->privilegeID }}"
												{{ (is_array(old('privilegeID',$rolePrivileges)) && in_array($privilege->privilegeID, old('privilegeID',$rolePrivileges))) ? ' checked' : '' }}
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
                    <input class="btn btn-primary" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@stop
