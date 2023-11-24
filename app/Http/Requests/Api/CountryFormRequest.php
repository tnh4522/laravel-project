<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CountryFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country_name' => 'required|max:255|unique:countries,country_name',
        ];
    }
    public function messages(): array
    {
        return [
            'country_name.required' => 'Country name is required!',
            'country_name.max' => 'Country name is max 255 characters!',
            'country_name.unique' => 'Country name is exists. Please try again!',
        ];
    }
}
