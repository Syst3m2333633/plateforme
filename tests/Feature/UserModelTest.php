<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_User_Has_Many_Client()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->client->contains($client));
        $this->assertEquals(1, User::count() && 1, Client::count());
    }
}
