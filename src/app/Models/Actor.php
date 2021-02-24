<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = ['proyecto_id', 'nombre', 'descripcion'];

    public function proyecto(){
        return $this->hasOne(Proyecto::class);
    }
}
