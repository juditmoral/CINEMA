<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrades extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcio_id',
        'seient_id',
        'users_id',
        'hora',
    ];

    protected $table ="entrades";

    public function funcio(){

        return $this->belongsTo(Funcions::class, 'funcio_id');
    }

    public function seient(){

        return $this->belongsTo(Seients::class, 'seient_id');
    }

    public function usuari(){

        return $this->belongsTo(User::class, 'users_id');
    }

}
