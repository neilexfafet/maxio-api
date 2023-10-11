<?php

namespace App\Http\Requests\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'subscription.product_handle' => 'required|string',
            'subscription.customer_attributes' => 'required|array',
            'subscription.customer_attributes.first_name' => 'required|string',
            'subscription.customer_attributes.last_name' => 'required|string',
            'subscription.customer_attributes.email' => 'required|email',
            'subscription.customer_attributes.zip' => 'required|integer',
            'subscription.customer_attributes.state' => 'required|string',
            'subscription.customer_attributes.reference' => 'required|string',
            'subscription.customer_attributes.phone' => 'required|string',
            'subscription.customer_attributes.organization' => 'required|string',
            'subscription.customer_attributes.country' => 'required|string',
            'subscription.customer_attributes.city' => 'required|string',
            'subscription.customer_attributes.address_2' => 'required|string',
            'subscription.customer_attributes.address' => 'required|string',
            'subscription.credit_card_attributes' => 'required|array',
            'subscription.credit_card_attributes.last_name' => 'required|string',
            'subscription.credit_card_attributes.first_name' => 'required',
            'subscription.credit_card_attributes.full_number' => 'required|integer',
            'subscription.credit_card_attributes.expiration_year' => 'required|integer',
            'subscription.credit_card_attributes.expiration_month' => 'required|integer',
            'subscription.credit_card_attributes.card_type' => 'required|string',
            'subscription.credit_card_attributes.billing_zip' => 'required|integer',
            'subscription.credit_card_attributes.billing_state' => 'required|string',
            'subscription.credit_card_attributes.billing_country' => 'required|string',
            'subscription.credit_card_attributes.billing_city' => 'required|string',
            'subscription.credit_card_attributes.billing_address_2' => 'required|string',
            'subscription.credit_card_attributes.billing_address' => 'required|string',
            'subscription.credit_card_attributes.cvv' => 'required|integer'
        ];
    }
}
