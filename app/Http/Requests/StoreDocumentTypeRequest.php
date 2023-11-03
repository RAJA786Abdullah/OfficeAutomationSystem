<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StoreDocumentTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        abort_if(Gate::denies('document_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:document_types',
            'code' => 'required',
            'department_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Document Type is required',
            'name.unique' => 'Document Type already exist',
            'code.required' => 'Document Code is required',
            'department_id.required' => 'Department is required'
        ];
    }
}
