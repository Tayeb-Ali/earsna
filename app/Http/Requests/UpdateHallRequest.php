<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHallRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:halls,name,' . $this->hall->name . ',name'],
            'city' => ['required', 'in:bahri,khartoum,madani,omdurman,port sudan'],
            'address' => ['required', 'string'],
            'capacity' => ['required', 'string', 'numeric'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
