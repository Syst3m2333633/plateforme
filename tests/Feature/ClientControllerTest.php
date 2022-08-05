<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_Admin_Can_See_Index_Client()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('client.index'));
        $response->assertViewIs('client.index');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_Create()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('client.create'));
        $response->assertViewIs('client.create');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_Profil()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('client.profil'));
        $response->assertViewIs('client.profil');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_Trash()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('client.trash'));
        $response->assertViewIs('client.trash');
    }
}
