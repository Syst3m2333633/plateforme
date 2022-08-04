<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    public function test_Admin_Can_Update_Client()
    {
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);

        $raisonSocial = 'wiklog';
        $slug = Str::slug($raisonSocial);

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
        $client = Client::factory()->create([
            'adresse' => '6 rue du gorge vert',
            'user_id' => $user->id,
        ])->where('adresse' == '6 rue du gorge bleu');
        $this->assertDatabaseHas('clients', [
            'adresse' => '6 rue du gorge vert'
        ]);
    }

    public function test_Admin_Can_Delete_Client()
    {
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);

        $raisonSocial = 'wiklog';
        $slug = Str::slug($raisonSocial);

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

            $client->Delete();
            $this->assertEquals(0, Client::count());

    }

    public function test_Admin_Can_Restore_Client()
    {
        $user = User::create([
            'name' => 'testUser',
            'email' => 'email.test@lol.fr',
            'password' => Hash::make('wiklog1234'),
        ]);

        $raisonSocial = 'wiklog';
        $slug = Str::slug($raisonSocial);

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

            $client->Delete();
            $client->restore();
            $this->assertEquals(1, Client::count());

    }
}
