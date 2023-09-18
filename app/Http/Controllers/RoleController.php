<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;


class RoleController extends Controller
{

    public function index(Request $request)
    {
        abort_if(Gate::denies('roles_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		if ($request->ajax()) {
            $query = Role::with('privileges.accessLevel')->get();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'roles_read';
                $editGate      = 'roles_update';
                $deleteGate    = 'roles_delete';
                $crudRoutePart = 'role';
                $primaryKey = 'roleID';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                    'primaryKey'
                ));
            });

            $table->editColumn('roleName', function ($row) {
                return $row->roleName;
            });
            // $table->addColumn('description', function ($row) {
            //     return $row->description;
            // });
            $table->addColumn('privileges', function ($row) {
                $privileges = [];
                foreach ($row->privileges as $rolePrivileges) {
                    $privileges[] = sprintf('<span class="badge bg-info">%s %s</span>', ucwords(strtolower(strtr($rolePrivileges->privilegeCode,'_',' '))),$rolePrivileges->accessLevel->accessLevel);
                }
                return implode(' ', $privileges);
            });
            // $table->addColumn('dateCreated', function ($row) {
            //     return $row->dateCreated;
            // });

            $table->rawColumns(['actions','privileges']);

            return $table->make(true);
        }
        return view('role.index');
    }

    public function create()
    {
		abort_if(Gate::denies('roles_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$accessLevels = \App\Models\AccessLevel::all();
		$privileges = \App\Models\Privilege::with(['modules','accessLevel'])->get();
		return view('role.create',compact('accessLevels','privileges'));
    }

    public function store(RoleStoreRequest $request)
    {
        DB::beginTransaction();
		try {
        $role = Role::create($request->except('privilegeID'));
        $role->privileges()->attach($request->privilegeID);
        DB::commit();
        $request->session()->flash('message', 'Role added successfully!');
		} catch (\Exception $e) {
			DB::rollback();
			$request->session()->flash('error', 'An error occurred while adding role!');
		}

        return redirect()->route('role.index');
    }

    public function show(Role $role)
    {
		abort_if(Gate::denies('roles_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$role = Role::with('privileges.modules')->find($role->roleID);
        return view('role.show', compact('role'));
    }

    public function edit(Role $role)
    {
		abort_if(Gate::denies('roles_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$accessLevels = \App\Models\AccessLevel::all();
		$privileges = \App\Models\Privilege::with(['modules','accessLevel'])->get();
		$rolePrivileges = \App\Models\RolePrivilege::where('roleID', $role->roleID)->get()->map(function ($item, $key) {
			return $item->privilegeID;
		})->toArray();

		return view('role.edit',compact('role','accessLevels','privileges','rolePrivileges'));
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
		DB::beginTransaction();
		try {
			$role->update($request->except('privilegeID'));
			$role->privileges()->detach();
			$role->privileges()->attach($request->privilegeID);
			DB::commit();
			$request->session()->flash('message', 'Role updated successfully!');
		} catch (\Exception $e) {
			DB::rollback();
			$request->session()->flash('error', 'An error occurred while updating role!');
		}

        return redirect()->route('role.index');
    }

    public function destroy(Role $role, Request $request)
    {
		abort_if(Gate::denies('roles_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		if (count($role->users->toArray()) >= 1) {
			$request->session()->flash('warning', 'Role cannot be deleted due to assigned User!');
		} else {
			DB::beginTransaction();
			try {
				$role->privileges()->detach();
				$role->delete();
				DB::commit();
				$request->session()->flash('message', 'Role deleted successfully!');
			} catch (\Exception $e) {
				DB::rollback();
				$request->session()->flash('error', 'An error occurred while deleting role!');
			}
		}
		return redirect()->route('role.index');
    }
}
