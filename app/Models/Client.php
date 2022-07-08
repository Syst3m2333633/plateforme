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
        'raisonSocial', 'slug', 'adresse', 'complAdresse', 'codePostal', 'ville', 'pays', 'telephone', 'name', 'firstname', 'email', 'password',
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
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'client.index';
    }

    public function getRouteKeyName()
{
    return 'slug';
}


}
