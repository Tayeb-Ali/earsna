<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class NewBookingRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'bookingTime_id' => ['required', 'exists:booking_times,id'],
            'offer_id' => ['required', 'exists:offers,id'],
            'payment_method' => ['required', 'in:bank,cash'],
            'paid_amount' => ['required', 'numeric'],
            'remaining_amount' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'status' => ['required', 'in:confirmed,temporary,paid,canceled'],
            'notes' => ['nullable', 'string']
        ];
    }
}
