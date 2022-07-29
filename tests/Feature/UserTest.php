<?php

namespace Tests\Feature;

use App\Http\Controllers\ClientController;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Create_User()
    {
        $admin = \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'catheland',
            'email' => 'alain.catheland@gmail.com',
            'password' => Hash::make('wiklog1234'),
            'is_admin' => 1,
        ]);
        $admin->assign('admin');

        $user = \App\Models\User::factory()->create([
            'id' => 2,
            'name' => 'client',
            'email' => 'client@example.com',
            'password' => Hash::make('wiklog1234'),
        ]);
        $user->assign('client');
        // $admin = \App\Models\User::factory()->create([
        //     'name' => 'catheland',
        //     'email' => 'alain.catheland@gmail.com',
        //     'password' => Hash::make('wiklog1234'),
        // ]);
        // $admin->assign('admin');

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'client',
        //     'email' => 'client@example.com',
        //     'password' => Hash::make('wiklog1234'),
        // ]);
        // $user->assign('client');
        // $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));
        // dd($response);
        $response->assertStatus(200);
    }

    public function test_if_user_not_logged_in()
    {
        $returnedValues = (new ClientController)->create();
        $this->assertEmpty($returnedValues);
    }


}
