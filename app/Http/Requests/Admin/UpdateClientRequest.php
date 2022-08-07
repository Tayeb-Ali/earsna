<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->user()->isAdmin() && ! $this->user()->isClient());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'exists:clients,name'],
            'phone' => ['required', 'string', 'unique:clients,phone,except,id'],
            'domain' => ['required', 'string', 'unique:domains,domain,except,id'],
            'address' => ['required', 'string'],
            'business_field' => ['required', 'exists:business_fields,field']
        ];
    }
}
