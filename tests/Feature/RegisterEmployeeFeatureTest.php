<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\signUp;

class RegisterEmployeeFeatureTest extends TestCase
{
    use RefreshDatabase;
    public function register()
    {
        Mail::fake();
        JWTAuth::shouldReceive('fromUser')->once()->andReturn('fake-token');

        $payload = [
            'name' => 'Youssef',
            'email' => 'youssef@example.com',
            'password' => 'secret123'
        ];

        $response = $this->postJson('/api/employees/register', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'employee' => [
                        'id',
                        'name',
                        'email',
                        'hiredAt'
                    ],
                    'token'
                ]
            ]);

        $this->assertDatabaseHas('employees', [
            'email' => 'youssef@example.com'
        ]);

        Mail::assertSent(signUp::class);
    }
}
