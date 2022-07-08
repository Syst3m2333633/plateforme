<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = \App\Models\User::factory()->create();
        $data = User::factory()->make()->getAttributes();
        $response = $this->actingAs($user)->post(route('user.store'), $data);

        // $response = $this->get('/');

        $response->assertStatus(200);
    }
}
