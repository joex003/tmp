<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;


class CreateEmployee
{
    public function create(array $data, bool $withToken = false): array
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $employee = Employee::create($data);
            Mail::to($employee->email)->send(new SignUp(employee: $employee));
            $response = ['employee' => $employee];
            if ($withToken) {
                $response['token'] = JWTAuth::fromUser($employee);
            }
            return $response;
        } catch (CustomException $error) {
            throw new CustomException(__('messages.registration_failed'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
