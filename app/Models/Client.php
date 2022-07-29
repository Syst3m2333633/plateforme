<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use SoftDeletes, HasFactory, Searchable;

    //Relation entre client et user
    public function user()
    {
        return $this->hasMany(Client::class);
    }

    //Relation entre client et devis
    public function devis()
    {
        return $this->hasMany(Devis::class);
    }

    protected $fillable = [
        'raisonSocial', 'slug', 'adresse', 'complAdresse', 'codePostal', 'ville', 'pays', 'telephone', 'name', 'firstname', 'email', 'logo', 'user_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'raisonSocial'
            ]
        ];
    }

    public function sluggableEvent(): string
    {
        /**
         * Default behaviour -- generate slug before model is saved.
         */
        return SluggableObserver::SAVING;

        /**
         * Optional behaviour -- generate slug after model is saved.
         * This will likely become the new default in the next major release.
         */
        // return SluggableObserver::SAVED;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role' => Role::class,
    ];

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->raisonSocial;
    }

    /**
     * Get the key name used to index the model.
     *
     * @return mixed
     */
    public function getScoutKeyName()
    {
        return 'raisonSocial';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageAttribute(): string
    {

        $image = storage_path($this->raisonSocial . '/logo/' . $this->avatar);

        return file_exists($image)

            ? $image

            : storage_path($this->raisonSocial . 'default.jpg');
    }
}
