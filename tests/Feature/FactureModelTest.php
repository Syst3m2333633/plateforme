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
    public function test_Facture_Belong_To_A_User()
    {
        $client = Client::factory()->create();
        $facture = Facture::factory()->create(['client_id' => $client->id]);
        $this->assertEquals(1, Facture::count() && 1, Client::count());
    }
}
