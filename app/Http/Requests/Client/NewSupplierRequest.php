<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class NewSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => ['required', 'string', 'unique:suppliers,name'],
            'email' => ['required', 'email', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'business_field_id' => ['required', 'exists:business_fields,id']
        ];
    }
}
