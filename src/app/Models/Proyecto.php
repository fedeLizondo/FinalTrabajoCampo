<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNull;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'user_id'];

    public function actors(){
        return $this->hasMany(Actor::class);
    }

    public function grupos(){
        return $this->hasMany(Grupo::class);
    }

    public function diagramas(){
        return $this->hasMany(Diagrama::class);
    }

    public function especificacions(){
        return $this->hasMany(Especificacion::class);
    }

    public function mensajes(){
        return $this->hasMany(Mensaje::class);
    }

    public function favoritos(){
        return $this->hasMany(Favorito::class);
    }

}
