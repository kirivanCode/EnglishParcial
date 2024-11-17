<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model // Cambia el nombre a singular
{
    use HasFactory;

    protected $fillable = ['codigo', 'nombre', 'modalidad', 'requisito'];

    // Relación uno a muchos con Grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function registros() // Cambia el nombre a plural
    {
        return $this->hasMany(Registro::class);
    }
}