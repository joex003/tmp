<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\signUp;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateEmployee
{
    public function create(array $data, bool $withToken = false): array
    {
        $data['password'] = Hash::make($data['password']);
        $employee = Employee::create($data);
        Mail::to($employee->email)->send(new signUp(employee: $employee));
        $response = ['employee' => $employee];
        if ($withToken) {
            $response['token'] = JWTAuth::fromUser($employee);
        }
        return $response;
    }
}
