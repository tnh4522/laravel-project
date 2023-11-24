<?php

namespace App\Http\Requests\Api;



use App\Http\Requests\Api\FormRequest;

class CheckOutRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|string|',
            'id_country' => 'required',
            'payment_method' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required',
            'email' => 'The :attribute must be a valid email address',
            'numeric' => 'The :attribute must be a number',
            'max' => 'The :attribute must be less than :max characters',
            'id_country.required' => 'The country field is required',
        ];
    }
}
