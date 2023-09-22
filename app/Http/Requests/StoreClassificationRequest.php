<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StoreClassificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        abort_if(Gate::denies('classifications_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            'document_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'path' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'document_id.required' => 'Document is required',
            'name.required' => 'Document Name is required',
            'type.required' => 'Document Type is required',
            'path.required' => 'File is required'
        ];
    }
}
