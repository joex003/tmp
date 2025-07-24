<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')
            ],
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => __('messages.email_taken')
        ];
    }

}
