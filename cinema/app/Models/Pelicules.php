<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicules extends Model
{
    use HasFactory;

    protected $table ="pelicules";

    public function funcio(){

        return $this->hasMany(Funcions::class);
  
    }

}
