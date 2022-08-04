<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    //Relation entre facture et client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $fillable = [
        'name', 'path', 'client_id'
    ];
}
