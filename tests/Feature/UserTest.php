<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Create_Admin_User()
    {
        $admin = \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'catheland',
            'email' => 'alain.catheland@gmail.com',
            'password' => Hash::make('wiklog1234'),
            'is_admin' => 1,
        ]);
        $admin->assign('admin');

        $response = $this->actingAs($admin)->get(route('dashboard'));
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Create_Client_User()
    {
        $admin = \App\Models\User::factory()->create([
            'id' => 2,
            'name' => 'client',
            'email' => 'client@example.com',
            'password' => Hash::make('wiklog1234'),
            'is_admin' => 0,
        ]);
        $admin->assign('client');

        $response = $this->actingAs($admin)->get(route('dashboard'));
        $response->assertStatus(200);
    }


    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function test_Relation_User_Clients()
    // {
    //     $user = User::factory()
    //             ->hasClient(1)
    //             ->create();
    //     $this->assertEquals(1, Client::count());
    // }

}
