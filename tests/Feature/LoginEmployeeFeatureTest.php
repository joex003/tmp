<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginEmployeeFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function registerTestEmployee(): array
    {
        $email = 'user_' . uniqid() . '@example.com';
        $password = 'secret123';

        $employee = Employee::create([
            'name' => 'Test User',
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return [
            'employee' => $employee,
            'credentials' => [
                'email' => $email,
                'password' => $password,
            ]
        ];
    }

    public function testLogin()
    {
        $data = $this->registerTestEmployee();

        $response = $this->postJson('/api/login', $data['credentials']);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token'
            ]);
    }
}
