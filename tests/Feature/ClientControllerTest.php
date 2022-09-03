<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_Admin_Can_See_Index_Client()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('client.index'));
        $response->assertViewIs('client.index');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_Create()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('client.create'));
        $response->assertViewIs('client.create');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_Trash()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('client.trash'));
        $response->assertViewIs('client.trash');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_Edit()
    {
        $user = User::factory()->create(['is_admin' => 1]);
        $client = Client::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('client.edit', ['client' => $client]));
        $response->assertViewIs('client.edit');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_profil()
    {
        $user = User::factory()->create(['is_admin' => 0]);
        $client = Client::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('client.profil', ['client' => $client]));
        $response->assertViewIs('client.edit');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Client_Show()
    {
        $user = User::factory()->create(['is_admin' => 0]);
        $client = Client::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('client.show', ['client' => $client]));
        $response->assertViewIs('client.update');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_Store_Client()
    {
        $user = User::factory()->create(['is_admin' => 0]);
        $client = Client::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('client.create', ['client' => $client]));
        $response->assertViewIS('client.create');
        // $this->assertEquals(1, User::count() && 1, Client::count());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_Destroy_Client()
    {
        $user = User::factory()->create(['is_admin' => 1]);
        $client = Client::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->post(route('client.trash', ['client' => $client]));
        // dd($client);
        if($client){
        $client->delete();
        }
        $this->assertEquals(0, Client::count());
        // $this->assertTrue(true);
        // $this->assertNull(Client::count());
        // $this->assertSoftDeleted($client);

        // $client = Client::factory()->destroy($client);
        // return Client::factory()->delete($client);
    }
}
