<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'string',
            'email' => [
                'email',
                Rule::unique('employees', 'email')->ignore(auth()->id())
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'email.unique' => __('messages.email_taken')
        ];
    }
}
