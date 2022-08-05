<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Devis;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevisModelTest extends TestCase
{
    use RefreshDatabase;
    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function test_example()
    // {
    //     $user = User::create([
    //         'name' => 'testUser',
    //         'email' => 'email.test@lol.fr',
    //         'password' => Hash::make('wiklog1234'),
    //     ])
    //     ->create()
    //     ->each(function ($user) {
    //          $user->posts()->save(Devis::factory)->make();
    //      });
    // }

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_Devis_Belong_To_A_User()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user->id]);
        $devis = Devis::factory()->create(['client_id' => $client->id]);
        $this->assertEquals(1, Devis::count() && 1, Client::count());
    }
}
