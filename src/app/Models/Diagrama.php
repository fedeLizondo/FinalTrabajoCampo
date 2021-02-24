<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagrama extends Model
{
    use HasFactory;

    protected $fillable = ['proyecto_id', 'nombre', 'documento', 'tipo'];

    public function proyecto(){
        return $this->hasOne(Proyecto::class);
    }

    public function mensajes(){
        return $this->hasMany(Mensaje::class);
    }
}
