<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcions extends Model
{
    use HasFactory;

    protected $table ="funcions";

    protected $fillable = ['pelicula_id','data', 'hora', 'numSala'];

    public function entrada(){

        return $this->hasMany(Entrades::class);
  
    }

    public function pelicula(){

        return $this->belongsTo(Pelicules::class, 'pelicula_id');
    }
}
