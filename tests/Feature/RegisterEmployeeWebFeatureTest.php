<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Mail\SignUp;

class RegisterEmployeeWebFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterWeb(): void
    {
        Mail::fake();

        $payload = [
            'name' => 'Youssef Web',
            'email' => 'web' . uniqid() . '@example.com',
            'password' => 'secret123',
        ];

        $response = $this->post('/employees/register', $payload);

        $response->assertRedirect(route('employee.home'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('employees', [
            'email' => $payload['email'],
        ]);

        Mail::assertSent(SignUp::class);
    }

}