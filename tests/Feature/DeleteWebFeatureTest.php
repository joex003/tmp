<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteWebFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_delete_account_through_Web(): void
    {
        $employee = Employee::create([
            'name' => 'ayahaga',
            'email' => 'delete' . uniqid() . '@example.com',
            'password' => bcrypt('secret123'),
        ]);

        $this->actingAs($employee);

        $response = $this->delete('/employees/delete');

        $response->assertRedirect('/create-employee');

        $this->assertDatabaseMissing('employees', [
            'id' => $employee->id,
        ]);
        $this->assertGuest();
    }
}
