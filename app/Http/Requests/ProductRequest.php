<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'web_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'availability' => 'required|integer',
            'condition' => 'required|integer',
            'sales' => 'integer',
            'description' => 'required|string',
            'details' => 'required|string',
            'manufacturer' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'brand_id.required' => 'Please select a brand.',
            'category_id.required' => 'Please select a category.',
            'availability.integer' => 'Please select availability.',
            'condition.integer' => 'Please select condition.',
            'sales.integer' => 'Please enter valid sales.',
            'max' => 'The :attribute may not be greater than :max characters.',
        ];
    }
}
