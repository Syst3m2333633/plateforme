<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Devis;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Event_Index()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('event.index'));
        $response->assertViewIs('event.index');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Client_Can_Create_Event()
    {
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);
        $document = UploadedFile::fake()->create('test.pdf');
        $documentName = $document->getClientOriginalName();
        $client = Client::factory()->create([
            'user_id' => $user->id,
        ]);
        $document->move(storage_path('app/'.$client->slug.'/devis'), $documentName);
        $devis = new Devis();
        $devis->name = $document;
        $devis->client_id = $client->id;
        $devis->save();
        $this->assertEquals(1, Devis::count());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_Download_Devis()
    {
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);
        $document = UploadedFile::fake()->create('testEvent.pdf');
        $documentName = $document->getClientOriginalName();
        $client = Client::factory()->create([
            'user_id' => $user->id,
        ]);
        // dd($document);
        $document->move(storage_path('app/'.$client->slug.'/event'), $documentName);
        $event = new Event();

        $event->client_id = $client->id;
        $event->save();
        $this->assertEquals(1, Event::count());

        return response()->download(storage_path('app/'.$client->slug.'/event/'.$documentName));
    }
}
