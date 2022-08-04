<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use Illuminate\Foundation\Auth\User;
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
    // public function test_Chek_Unique_Email_User()
    // {
    //     $admin = \App\Models\User::factory()->create([
    //         'id' => 2,
    //         'name' => 'client',
    //         'email' => 'client@example.com',
    //         'password' => Hash::make('wiklog1234'),
    //         'is_admin' => 0,
    //     ]);
    //     $admin->assign('client');

    //     $response = $this->actingAs($admin)->get(route('dashboard'));
    //     $response->assertStatus(200);
    // }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function test_Update_Client_User()
    // {
    //     $client = Client::all();
    //     $admin = \App\Models\User::factory()->create([
    //         'id' => 2,
    //         'name' => 'client',
    //         'email' => 'client@exemple.com',
    //         'password' => Hash::make('wiklog1234'),
    //         'is_admin' => 0,
    //     ]);
    //     $admin->assign('client');

    //     $response = $this->actingAs($admin)->get(route('client.update', ['client' => $admin]));
    //     $response->assertStatus(200);
    // }



    // public function test_if_user_not_logged_in()
    // {
    //     $returnedValues = (new ClientController)->create();
    //     $this->assertEmpty($returnedValues);
    // }


}
