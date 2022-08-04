<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $raisonSocial = $this->faker->company();
        $slug = Str::slug($raisonSocial);
        Storage::MakeDirectory($slug . '/logo');
        Storage::MakeDirectory($slug . '/devis');
        Storage::MakeDirectory($slug . '/factures');
        Storage::MakeDirectory($slug . '/event');
        return [
            'raisonSocial' => $raisonSocial,
            // $slug = 'raisonSocial' => $this->faker->company(),
            'slug' => $slug,
            'adresse' => $this->faker->address(),
            'complAdresse' => $this->faker->text(),
            'codePostal' => $this->faker->postcode(),
            'ville' => $this->faker->city(),
            'pays' => $this->faker->country(),
            'telephone' => $this->faker->phoneNumber(),
            'name' => $this->faker->name(),
            'firstname' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            // 'avatar' => $this->faker->imageURL(640, 480),
            'user_id' => $this->faker->numberBetween(1, 2),
            // 'user_id' => $this->faker->13,
        ];
    }
}
