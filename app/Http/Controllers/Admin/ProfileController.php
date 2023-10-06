<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if (strlen(trim($request->password))){
            $newPassword = Hash::make($request->password);
        }
        if (Hash::check($request->oldPassword, auth()->user()->password)) {
            auth()->user()->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => ($newPassword)
            ]);
            return redirect()->route('home')->with('message','Password Changed Successfully');
        } else {
            return redirect()->route('profile.show')->with('errorMessage','Something went Wrong!');
        }
    }
}