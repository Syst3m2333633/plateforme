<?php

namespace Database\Seeders;

use App\Models\Client;
use Bouncer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\DevisSeeder;
use Database\Seeders\ClientSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            ClientSeeder::class,
        ]);

        \Bouncer::allow('admin')->toManage(Client::class);
        \Bouncer::allow('admin')->toManage(User::class);
        //\Bouncer::allow('admin')->to('update', \App\Models\User::class);

        $admin = \App\Models\User::factory()->create([
            'name' => 'catheland',
            'email' => 'alain.catheland@gmail.com',
            'password' => Hash::make('wiklog1234'),
        ]);
        $admin->assign('admin');

        $user = \App\Models\User::factory()->create([
            'email' => 'client@example.com',
            'password' => Hash::make('wiklog1234'),
        ]);
        $user->assign('client');

    }
}
