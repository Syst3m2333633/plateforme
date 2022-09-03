<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class ClientCRUDTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if database is empty
     */
    public function test_count_empty_client()
    {
        $this->assertEquals(0, Client::count());
    }

    public function test_Admin_Can_Create_User()
    {
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);
        // dd(user::all());
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);
    }

    public function test_Admin_Can_Create_Client()
    {
        $raisonSocial = 'wiklog';
        $slug = Str::slug($raisonSocial);
        $file = UploadedFile::fake()->image('avatar.jpg');
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);

        $client = Client::create([
            'raisonSocial' => $raisonSocial,
            'slug' => $slug,
            'adresse' => '6 rue du gorge bleu',
            'complAdresse' => '3eme bureau à gauche',
            'codePostal' => '44350',
            'ville' => 'Guérande',
            'pays' => 'France',
            'telephone' => '0612555754',
            'name' => 'Hervy',
            'firstname' => 'Stéphane',
            'email' => 'stephane.hervy@wiklog.fr',
            'user_id' => $user->id,
        ]);
        $this->assertEquals(1, Client::count());
    }
}
