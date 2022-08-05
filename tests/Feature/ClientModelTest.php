<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientModelTest extends TestCase
{
    use RefreshDatabase;

    // /**
    // * A basic feature test example.
    // *
    // * @return void
    // */
    // public function test_Client_Belong_To_A_User()
    // {
    //     $client = Client::factory()->count(2)->create();
    //     $user = User::factory()->create(['user_id' => $client->id]);

    //     $this->assertInstanceOf(Client::class, $user->client);
    // }

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_Client_Belong_To_A_User()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $this->assertEquals(1, Client::count() && 1, User::count());
    }

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_Event_Belong_To_A_Client()
    {
        $user = User::factory()->create();
        // $client = Client::factory()->create(['user_id' => $user->id]);
        $event = Event::factory()->create();
        $client = $event->client;
        $this->assertNotNull($client);
        $this->assertEquals(1, Event::count() && 1, Client::count());
    }

}
