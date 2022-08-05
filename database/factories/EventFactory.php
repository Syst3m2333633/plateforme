<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $client = Client::factory()->create();
        // foreach ($clients as $client) {
            $name = $client->raisonSocial;
            $slug = Str::slug($name);
            // dd($client);
            return [
                'titre' => $this->faker->title(),
                'message' => $this->faker->text(),
                'path' => storage_path('app/'.$slug.'/event'),
                'client_id' => $client->id,

                'created_at' => $this->faker->date(),
            ];
        // }
    }
}
