<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class StoreDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        abort_if(Gate::denies('documents_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            'classification_id' => 'required',
            'document_type_id' => 'required',
            'file_id' => 'required',
            'subject' => 'required',
            'to' => 'required',
            'info' => 'required',
            'signing_authority_id' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'classification_id.required' => 'Classification is required',
            'document_type_id.required' => 'Document Type is required',
            'file_id.required' => 'File is required',
            'subject.required' => 'Subject is required',
            'to.required' => 'To is required',
            'info.required' => 'Info is required',
            'signing_authority_id.required' => 'Signing Authority is required',
        ];
    }
}
