<?php

namespace App\Http\Requests\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subscription' => 'required|array',
            'subscription.credit_card_attributes' => 'required|array',
            'subscription.credit_card_attributes.full_number' => 'required|integer',
            'subscription.credit_card_attributes.expiration_month' => 'required|integer',
            'subscription.credit_card_attributes.expiration_year' => 'required|integer',
            'subscription.credit_card_attributes.cvv' => 'required|integer',
            'subscription.next_billing_at' => 'required|date',
        ];
    }
}
