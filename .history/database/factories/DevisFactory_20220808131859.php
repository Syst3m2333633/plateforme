<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Devis>
 */
class DevisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $clients = Client::all();
        foreach ($clients as $client) {
            $name = $client->raisonSocial;
            $slug = Str::slug($name);
            // dd($file);
            $documentname = 'devis.' . $slug .'.pdf';
            $document = UploadedFile::fake()->create($documentname);
            $file = UploadedFile::fake()->create('devis.' . $slug .'.pdf')->storage_path('app/'.$slug.'/devis');
            // Storage_path('app/'.$slug.'/devis');


            return [
                'name' => $this->faker->randomElement($array = ['Mise à jour', 'Ajout de fonctionnalité', 'Migration de serveur', 'Débogage', 'Transfert de BDD', 'Correction général', 'Création de site internet vitrine', 'création site e-commerce']),
                'size' => $this->faker->randomFloat(),
                'location' => storage_path('app/'.$slug.'/devis'),
                'client_id' => $this->faker->numberBetween(1, 50),
                'created_at' => $this->faker->date(),
            ];
        }
    }
}
