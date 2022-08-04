<?php

namespace App\Models;

use App\Models\Devis;
use App\Models\Facture;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndAbilities;

    //Relation entre user et devis
    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }

    //Relation entre user et facture
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }

    //Relation entre user et client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role' => Role::class,
        'email_verified_at' => 'datetime',
    ];

    public function files()
    {
      return $this->hasMany(File::class);
    }
}
