<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\Facture;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FactureControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Facture_Index()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('facture.index'));
        $response->assertViewIs('facture.index');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_See_Facture_Create()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('facture.create'));
        $response->assertViewIs('facture.create');
    }

/**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Admin_Can_Create_Factures()
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
        $document->move(storage_path('app/' . $client->slug . '/facture'), $documentName);
        $facture = new Facture();
        $facture->name = $document;
        $facture->client_id = $client->id;
        $facture->save();
        $this->assertEquals(1, Facture::count());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Client_Can_Download_Facture()
    {
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);
        $document = UploadedFile::fake()->create('testFacture.pdf');
        $documentName = $document->getClientOriginalName();
        $client = Client::factory()->create([
            'user_id' => $user->id,
        ]);
        // dd($document);
        $document->move(storage_path('app/' . $client->slug . '/facture'), $documentName);
        $facture = new Facture();
        $facture->name = $document;
        $facture->client_id = $client->id;
        $facture->save();
        $this->assertEquals(1, Facture::count());
        // dd($documentName);
        return response()->download(storage_path('app/' . $client->slug . '/facture/' . $documentName));
        // $response = response('File contents', 200, [
        //     'Content-Disposition: inline',
        //     'Content-Type' => 'application/json',
        //     'content-Disposition' => 'attachment; filename="test.pdf',
        // ]);
        // dd($document);
        // $response = $this->actingAs($user)
        //     ->getJson(route('devis.store', ['path' => $document]));
        // $response->assertDownload($devis);
    }

}
