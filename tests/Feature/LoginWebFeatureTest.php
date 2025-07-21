<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginWebFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginWeb(): void
    {
        $employee = Employee::create([
            'name' => 'Youssef Web',
            'email' => 'web' . uniqid() . '@example.com',
            'password' => bcrypt('secret123'),
        ]);

        $payload = [
            'email' => $employee->email,
            'password' => 'secret123',
        ];
        $response = $this->post('/employees/login', $payload);

        $response->assertRedirect('/home');

        $this->assertAuthenticatedAs($employee);
    }
}
