<?php

namespace Tests\Traits;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

trait CreatesTestEmployee
{
    protected function createAndLoginEmployee(): array
    {
        $email = 'user_' . uniqid() . '@example.com';
        $password = 'secret123';

        $employee = Employee::create([
            'name' => 'Original Name',
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $token = JWTAuth::fromUser($employee);

        return [
            'employee' => $employee,
            'token' => $token,
        ];
    }
}
