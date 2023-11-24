<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'email|unique:users,email,',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'id_country' => 'required|int',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required',
            'email' => 'The :attribute field is not valid',
            'unique' => 'The :attribute field is already exist',
            'numeric' => 'The :attribute field must be a number',
            'image' => 'The :attribute field must be an image',
            'mimes' => 'The :attribute field must be a file of type: jpeg, png, jpg, gif, svg',
            'max' => 'The :attribute field must be less than 1MB'
        ];
    }
}
