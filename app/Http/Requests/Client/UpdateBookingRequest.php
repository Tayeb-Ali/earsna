<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            'date' => ['nullable', 'date'],
            'bookingTime_id' => ['nullable', 'exists:booking_times,id'],
            'offer_id' => ['required', 'exists:offers,id'],
            'payment_method' => ['required', 'in:bank,cash'],
            'paid' => ['nullable', 'regex:/^[0-9\.,]+$/', 'not_in:0'],
            'remaining' => ['nullable', 'regex:/^[0-9\.,]+$/', 'not_in:0'],
            'total' => ['nullable', 'regex:/^[0-9\.,]+$/', 'not_in:0'],
            'status' => ['required', 'in:confirmed,temporary,paid,canceled'],
            'notes' => ['nullable', 'string']
        ];
    }
}
