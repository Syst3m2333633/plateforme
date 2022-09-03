<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventModelTest extends TestCase
{
    use RefreshDatabase;
    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_Event_Belong_To_A_Client()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $event = Event::factory()->create(['client_id' => $client->id]);
        $client = $event->client;
        $this->assertNotNull($client);
        $this->assertEquals(1, Event::count() && 1, Client::count());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Event_Create()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('event.create'));
        $response->assertViewIs('event.create');
    }
}
