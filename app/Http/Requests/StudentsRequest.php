<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:students,code|min:5|regex:/^([a-zA-Z0-9]+)*$/',
            'fullname' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3',
            'notelp' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'fullname.regex' => 'The :attribute name must be string',
        ];
    }
}
