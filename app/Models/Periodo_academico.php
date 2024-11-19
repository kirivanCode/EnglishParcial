<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo_academico extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['año', 'trimestre', 'nombre'];

    // Relación uno a muchos con Grupos
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
}
