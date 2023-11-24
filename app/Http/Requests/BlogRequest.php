<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required|string',
            'content' => 'required|string'
        ];
    }
    public function  messages() : array
    {
        return [
            'required' => 'The :attribute field is required',
            'image' => 'The :attribute field must be an image',
            'mimes' => 'The :attribute field must be a file of type: jpeg, png, jpg, svg',
            'max' => 'The :attribute field must be less than 1MB'
        ];
    }
}
