<?php

namespace App\Models;

use App\Http\Resources\ProyectoActorResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'email', 'proyecto_id', 'is_admin'];

    public function users(){
        return $this->hasMany(User::class);
    }
    
    public function proyectos(){
        return $this->hasMany(ProyectoActorResource::class);
    }

}
