<?php

namespace Database\Seeders;

use App\Models\Facture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facture::factory()->count(10)->create();
    }
}
