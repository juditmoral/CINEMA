<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seients extends Model
{
    use HasFactory;

    protected $table ="seient";

    public function entrada(){

        return $this->hasMany(Entrades::class);
  
    }
}
