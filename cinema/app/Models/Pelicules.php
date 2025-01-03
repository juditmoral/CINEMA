<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicules extends Model
{
    use HasFactory;

    protected $table ="pelicules";

    protected $fillable = [
        'duracio',
        'titul_es',
        'titul_ca',
        'titul_en',
        'descripció_es',
        'descripció_ca',
        'descripció_en',
        'pais_es',
        'pais_ca',
        'pais_en',
        'genere_es',
        'genere_ca',
        'genere_en',
        'data',
        'director',
        'url',
    ];

    public function funcio(){

        return $this->hasMany(Funcions::class);
  
    }

}
