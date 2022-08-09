<?php

namespace Database\Seeders;

use App\Models\Devis;
use Illuminate\Database\Seeder;

class DevisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Devis::factory()->count(10)->create();
    }
}
