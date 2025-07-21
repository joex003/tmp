<?php

namespace App\Services;

use App\Exceptions\Custom;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginEmployee
{
    public function login(array $data, bool $withToken = false): array
    {
        $employee = Employee::where('email', $data['email'])->first();

        if (!$employee || !Hash::check($data['password'], $employee->password)) {
            throw new Custom(__('messages.invalid_credentials'), 401);
        }

        auth()->login($employee);

        $result = ['employee' => $employee];

        if ($withToken) {
            $result['token'] = JWTAuth::fromUser($employee);
        }

        return $result;
    }
}
