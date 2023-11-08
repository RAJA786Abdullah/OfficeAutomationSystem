<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => "required|unique:users",
            'password' => [
                'required',
                'min:8',
                'regex:/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-=\|]/',
            ],
            'confirmPassword' => 'required|same:password',
            'roleID' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'User Name is required',
            'email.unique' => 'User Name already exist',
            'password.required' => 'Password is required',
            'password.regex' => 'Special Characters required',
            'password.min' => 'Minimum Eight Characters required',
            'confirmPassword.required' => 'Confirm Password is required',
            'roleID.required' => 'Role is required'
        ];
    }
}
