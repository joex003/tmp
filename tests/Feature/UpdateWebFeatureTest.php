<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateWebFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateWeb(): void
    {
        $employee = Employee::create([
            'name' => 'ayhaga',
            'email' => 'update' . uniqid() . '@example.com',
            'password' => bcrypt('secret123'),
        ]);

        $this->actingAs($employee);

        $payload = [
            'name' => 'Updated Name',
            'email' => 'updated' . uniqid() . '@example.com',
        ];

        $response = $this->put('/employees/update', $payload);

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'name' => 'Updated Name',
            'email' => $payload['email'],
        ]);
    }
}
