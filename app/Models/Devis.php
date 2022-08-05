<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Devis
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $size
 * @property string|null $location
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Client $client
 *
 * @method static \Database\Factories\DevisFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Devis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Devis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Devis extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'path', 'client_id',
    ];

    //Relation entre devis et client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
