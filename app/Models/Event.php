<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'message', 'client_id'
    ];

     //Relation entre event et client
     public function client()
     {
         return $this->belongsTo(Client::class);
     }

}
