<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especificacion extends Model
{
    use HasFactory;

    protected $fillable = ['proyecto_id', 'nombre', 'tipo', 'documento'];

    public function proyecto()
    {
        return $this->hasOne(Proyecto::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }
}
