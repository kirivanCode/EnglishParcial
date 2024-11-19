<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model // Cambia el nombre a singular
{
    use HasFactory;
    use SoftDeletes;

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