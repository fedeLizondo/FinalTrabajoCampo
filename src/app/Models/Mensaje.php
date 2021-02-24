<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
    protected $fillable = ['mensaje', 'user_id', 'proyecto_id', 'diagrama_id', 'especificacion_id'];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function proyecto(){
        return $this->hasOne(Proyecto::class);
    }

    public function diagrama(){
        return $this->hasOne(Diagrama::class);
    }

    public function especificacion(){
        return $this->hasOne(Especificacion::class);
    }

}
