<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|string',
            'id_country' => 'required|int',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required|min:8|max:20|same:password'
        ];
    }
    public function messages() : array
    {
        return [
            'required' => 'The :attribute field is required',
            'email' => 'The :attribute is not valid',
            'unique' => 'The :attribute is already exist',
            'numeric' => 'The :attribute must be a number',
            'image' => 'The :attribute must be an image',
            'mimes' => 'The :attribute must be a file of type: jpeg, png, jpg, gif, svg',
            'max' => 'The :attribute must be less than 1MB',
            'min' => 'The :attribute must be at least 8 characters',
            'confirmed' => 'The :attribute confirmation does not match'
        ];
    }
}
