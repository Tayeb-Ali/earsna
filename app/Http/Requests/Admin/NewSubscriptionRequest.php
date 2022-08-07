<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewSubscriptionRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            'package_id' => ['required', 'exists:packages,id'],
            'halls' => ['required', 'array'],
            'halls.*.name' => ['required', 'string', 'unique:halls,name', 'max:255'],
            'halls.*.city' => ['required', 'in:bahri,khartoum,madani,omdurman,port sudan', 'max:255'],
            'halls.*.address' => ['required', 'string', 'max:255'],
            'halls.*.capacity' => ['required', 'string', 'numeric'],
        ];
    }
}
