<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Devis;
use App\Models\Event;
use App\Models\Client;
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
        $client = $user->client;
        $this->assertNotNull($client);
        $this->assertEquals(1, Client::count() && 1, User::count());
    }

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_Client_Has_Many_Devis()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $devis = Devis::factory()->create(['client_id' => $client->id]);
        $this->assertTrue($client->devis->contains($devis));
        $this->assertEquals(1, Devis::count() && 1, Client::count() && 1, User::count());
    }

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_Client_Has_Many_Event()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $event = Event::factory()->create(['client_id' => $client->id]);
        $this->assertTrue($client->event->contains($event));
        $this->assertEquals(1, User::count() && 1, Client::count() && 1, User::count());
    }
}
