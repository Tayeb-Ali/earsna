<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackageRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:225', Rule::unique('packages')->ignore($this->package->id, 'id') ],
            'features' => ['required', 'exists:features,id'],
            'price' => ['required', 'numeric']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'price' => $this->price * 100
        ]);
    }
}

