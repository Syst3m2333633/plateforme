<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_avatars_can_be_uploaded()
    {
        $user = \App\Models\User::factory()->create();
        Storage::makeDirectory(Str::slug($user->name) . '/logo');
        $file = UploadedFile::fake()->image('avatar.jpg');

            $response = $this->actingAs($user)->json('POST', 'client.store', [
                'avatar' => $file
            ])->assertStatus(200);
            // Assert the file was stored...

        Storage::storage_path($user->name . '/logo')->assertExists($file->hashName());
        // $data = Client::factory()->make()->getAttributes();
        // $response = $this->actingAs($user)->post(route('client.store'), $data);
        // $response->assertStatus(200);
    }


    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function test_Store_Client()
    // {
    //     Storage::fake('avatars');

    //     $file = UploadedFile::fake()->image('avatar.jpg');

    //     $response = $this->post('local', [
    //         'avatar' => $file,
    //     ]);
    //     Storage::disk('local')->assertExists($file->hashName());

    //     // $user = User::factory()->create();
    //     // $data = Client::factory()->make()->getAttributes();
    //     // $response = $this->actingAs($user)->post(route('client.store'), $data);
    //     $response->assertStatus(200);
    // }

    // public function test_Store_Client()
    // {
    //     $user = Client::factory()->create();
    //     $data = Client::factory()->make()->getAttributes();
    //     $response = $this->actingAs($user)->get(route('client.store'), $data);
    //     $response->assertStatus(200);
    // }
}
