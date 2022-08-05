<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_Create_Client()
    {
        $admin = \App\Models\User::factory()->create([
            'id' => 2,
            'name' => 'client',
            'email' => 'client@example.com',
            'password' => Hash::make('wiklog1234'),
            'is_admin' => 0,
        ]);
        $admin->assign('client');

        $response = $this->actingAs($admin)->get(route('dashboard'));
        $response->assertStatus(200);
    }
}
