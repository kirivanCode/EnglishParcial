<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuarios extends Model
{

    use SoftDeletes;
    protected $fillable = ['nombre', 'tipo_rol', 'matriculas_id'];

    // Relación con Role
    public function rol()
    {
        return $this->belongsTo(Roles::class, 'tipo_rol'); // tipo_rol es el campo que actúa como clave foránea
    }

    // Relación con Matrícula
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

    // Relación con Grupo
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'docente_id');
    }   

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
    
}