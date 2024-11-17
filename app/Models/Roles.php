<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    // Relación uno a muchos con Usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
