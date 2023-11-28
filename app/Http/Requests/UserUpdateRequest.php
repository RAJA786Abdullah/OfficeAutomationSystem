<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-=\|]/',
            ],
            'confirmPassword' => 'required|same:password',
            'roleID' => 'required',
            'is_signing_authority' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'User Name is required',
            'password.required' => 'Password is required',
            'password.regex' => 'Special Characters required',
            'password.min' => 'Minimum Eight Characters required',
            'confirmPassword.required' => 'Confirm Password is required',
            'roleID.required' => 'Role is required',
            'is_signing_authority.required' => 'Signing Authority is required'
        ];
    }
}
