<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginEmployeeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email'=>'email|required',
            'password'=>'string|required'
        ];
    }
}
