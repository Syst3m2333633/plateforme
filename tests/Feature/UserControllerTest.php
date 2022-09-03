<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_Client_Can_See_Index_Client()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $client = Client::factory()->create(['user_id' => $admin->id]);
        $response = $this->actingAs($admin)->get(route('user.index'));
        $response->assertViewIs('user.index');
    }

    public function test_Client_Can_See_Index_Create()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $client = Client::factory()->create(['user_id' => $admin->id]);
        $response = $this->actingAs($admin)->get(route('user.create'));
        $response->assertViewIs('user.create');
    }


    public function test_Client_Can_See_Edit_Client()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $client = Client::factory()->create(['user_id' => $admin->id]);
        $response = $this->actingAs($admin)->get(route('user.edit', ['user' => $client->id]));
        $response->assertViewIs('user.create');
    }
}
