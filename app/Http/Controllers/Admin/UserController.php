<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with('roles')->get();
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $departments = Department::all();
        $branches = Branch::all();
        $roles = Role::all()->sortBy('roleName');
        return view('admin.users.create',compact('roles', 'departments', 'branches'));
    }

    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();
        try {
        $request->merge([
                'password' => Hash::make($request->password)
            ]);
        $user = User::create($request->except(['roleID','confirmPassword']));
        $user->roles()->attach($request->roleID);
            DB::commit();
            $request->session()->flash('message', 'User added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('errorMessage', 'An error occurred while adding user!');
        }
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('department','branch','roles');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('department', 'branch');


        $departments = Department::all();
        $branches = Branch::all();

        $roles = \App\Models\Role::all()->sortBy('roleName');
        $userRoles = $user->roles->map(function ($item, $key) {
            return $item->roleID;
        })->toArray();
        return view('admin.users.edit',compact('user','roles','userRoles', 'departments', 'branches'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            if (strlen(trim($request->password))){
                $newPassword = Hash::make($request->password);
            }
            if (Hash::check($request->oldPassword, $user->password)) {
                $request->merge([
                    'password' => $newPassword
                ]);
                $user->update($request->except(['roleID','confirmPassword', 'oldPassword']));
                $user->roles()->sync($request->roleID);
                DB::commit();
                $request->session()->flash('message', 'User updated successfully!');
                return redirect()->route('users.index');
            } else {
                $request->session()->flash('errorMessage', 'Old Password does not match');
                return redirect()->route('users.edit',$user->userID);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            $request->session()->flash('errorMessage', 'An error occurred while updating user!');
            return redirect()->route('users.index');
        }
    }

    public function destroy(User $user, Request $request)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        try {
            $user->roles()->detach();
            $user->delete();
            DB::commit();
            $request->session()->flash('message', 'User deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('errorMessage', 'An error occurred while deleting user!');
        }
        return redirect()->route('users.index');
    }
}
