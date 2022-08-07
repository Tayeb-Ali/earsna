<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewHallRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:halls,name'],
            'city' => ['required', 'in:bahri,khartoum,madani,omdurman,port sudan', 'max:255'],
            'address' => ['required', 'string'],
            'capacity' => ['required', 'string', 'numeric'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
