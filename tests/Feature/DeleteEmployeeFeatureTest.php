<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\Traits\CreatesTestEmployee;


class DeleteEmployeeFeatureTest extends TestCase
{
    use RefreshDatabase, CreatesTestEmployee;

    public function testDelete(): void
    {
        $data = $this->createAndLoginEmployee();

        $response = $this->withHeader('Authorization', 'Bearer ' . $data['token'])
            ->deleteJson('/api/employees/delete');
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => __('messages.employee_deleted'),
            ]);

        $this->assertDatabaseMissing('employees', [
            'id' => $data['employee']->id,
        ]);
    }

}
