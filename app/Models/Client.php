<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use SoftDeletes, HasFactory, Searchable;

    protected $fillable = [
        'raisonSocial', 'slug', 'adresse', 'complAdresse', 'codePostal', 'ville', 'pays', 'telephone', 'name', 'firstname', 'email', 'logo'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'raisonSocial'
            ]
        ];
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

        $image = storage_path($this->raisonSocial . '/logo/'. $this->avatar);

        return file_exists($image)

            ? $image

            : storage_path($this->raisonSocial . 'default.jpg');
    }
}
