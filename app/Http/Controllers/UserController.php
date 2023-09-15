<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = \App\Models\Role::all()->sortBy('roleName');
        return view('users.create',compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();
        try {
        $request->merge([
                'password' => Hash::make($request->password)
            ]);
        $request['userTypeID'] = 2;
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
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = \App\Models\Role::all()->sortBy('roleName');
        $userRoles = $user->roles->map(function ($item, $key) {
            return $item->roleID;
        })->toArray();
        return view('users.edit',compact('user','roles','userRoles'));
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
                $request['userTypeID'] = 1;
                $user->update($request->except(['roleID','confirmPassword']));
                $user->roles()->sync($request->roleID);
                DB::commit();
                $request->session()->flash('message', 'User updated successfully!');
                return redirect()->route('users.index');
            } else {
                $request->session()->flash('errorMessage', 'Old Password does not match');
                return redirect()->route('users.edit',$user->userID);
            }
        } catch (\Exception $e) {
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
