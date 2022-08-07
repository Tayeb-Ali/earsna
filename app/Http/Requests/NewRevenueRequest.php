<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRevenueRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'payment_method' => ['required', 'in:cash,bank'],
            'amount' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:collected,uncollected']
        ];
    }
}
