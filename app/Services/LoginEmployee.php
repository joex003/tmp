<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class LoginEmployee
{
    public function login(array $data, bool $withToken = false): array
    {
        try {
            $employee = Employee::where('email', $data['email'])->first();

            if (!$employee || !Hash::check($data['password'], $employee->password)) {
                throw new CustomException(__('messages.invalid_credentials'), RESPONSE::HTTP_UNAUTHORIZED);
            }

            auth()->login($employee);

            $result = ['employee' => $employee];

            if ($withToken) {
                $result['token'] = JWTAuth::fromUser($employee);
            }

            return $result;
        } catch (CustomException $error) {
            throw $error;
        }
    }
}
