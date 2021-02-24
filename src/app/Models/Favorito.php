<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'proyecto_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function proyecto()
    {
        return $this->hasOne(Proyecto::class);
    }
}
