<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Facture;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FactureModelTest extends TestCase
{
    use RefreshDatabase;
    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_Facture_Belong_To_A_Client()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $facture = Facture::factory()->create(['client_id' => $client->id]);
        $client = $facture->client;
        $this->assertNotNull($client);
        $this->assertEquals(1, Facture::count() && 1, Client::count());
    }
}
