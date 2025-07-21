<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterEmployee extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'email'=>'required|email|unique:employees,email',
            'password'=>'required'
        ];
    }
    public function messages()
{
    return [
        'email.unique' => 'This email is already registered.',
    ];
}

}
