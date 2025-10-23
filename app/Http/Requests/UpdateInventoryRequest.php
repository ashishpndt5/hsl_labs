<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'quantity_change' => 'required|integer|not_in:0',
        ];
    }
    public function messages(): array
    {
        return [
            'product_id.required' => 'Please select a valid product.',
            'quantity_change.required' => 'Please enter a quantity to add or remove.',
            'quantity_change.integer' => 'Quantity must be a number.',
            'quantity_change.not_in' => 'Quantity change cannot be zero.',
        ];
    }
}
