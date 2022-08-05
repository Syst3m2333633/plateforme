<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $raisonSocial
 * @property string $slug
 * @property string|null $adresse
 * @property string|null $complAdresse
 * @property string|null $codePostal
 * @property string|null $ville
 * @property string|null $pays
 * @property string|null $telephone
 * @property string $name
 * @property string|null $firstname
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string|null $CodeClimate
 * @property string|null $CodeCov
 * @property string|null $CodeMatomo
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|array<\App\Models\Devis> $devis
 * @property-read int|null $devis_count
 * @property-read \Illuminate\Database\Eloquent\Collection|array<\App\Models\Devis> $event
 * @property-read int|null $event_count
 * @property-read string $image
 * @property-read \Illuminate\Database\Eloquent\Collection|array<Client> $user
 * @property-read int|null $user_count
 *
 * @method static \Database\Factories\ClientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Query\Builder|Client onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCodeClimate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCodeCov($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCodeMatomo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCodePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereComplAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRaisonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereVille($value)
 * @method static \Illuminate\Database\Query\Builder|Client withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Client withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Client extends Model
{
    use SoftDeletes, HasFactory, Searchable;

    protected $fillable = [
        'raisonSocial', 'slug', 'adresse', 'complAdresse', 'codePostal', 'ville', 'pays', 'telephone', 'name', 'firstname', 'email', 'logo', 'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role' => Role::class,
    ];

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

    //Relation entre client et event
    public function event()
    {
        return $this->hasMany(Devis::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'raisonSocial',
            ],
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
        $image = storage_path('app/'. $this->raisonSocial.'/logo/'.$this->avatar);

        return file_exists($image)

            ? $image

            : storage_path($this->raisonSocial.'default.jpg');
    }
}
