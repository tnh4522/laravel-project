<?php

namespace App\Http\Requests\Api;


use App\Http\Requests\Api\FormRequest;

class CommentRequest extends FormRequest
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
            'id_blog' => 'required',
            'id_user'=>'required',
            'name_user' => 'required',
            'id_parent' => 'required',
            'comment' => 'required',
            'image_user' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required'=>'The :attribute field is required',
        ];
    }
}
