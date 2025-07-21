<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\Traits\CreatesTestEmployee;


class UpdateEmployeeFeatureTest extends TestCase
{
    use RefreshDatabase, CreatesTestEmployee;

    public function testUpdate()
    {
        $data = $this->createAndLoginEmployee();

        $updatedPayload = [
            'name' => 'Updated Name',
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $data['token'])
            ->putJson('/api/employees/update', $updatedPayload);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => __('messages.profile_updated'),
            ]);

        $this->assertDatabaseHas('employees', [
            'id' => $data['employee']->id,
            'name' => 'Updated Name',
        ]);
    }
}
