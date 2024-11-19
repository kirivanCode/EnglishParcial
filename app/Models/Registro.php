<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'estado',
        'grupo_id',
        'curso_id',
        'usuario_id',
        'periodo_academico_id',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id'); // Cambia a 'Curso'
    }

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id'); // Cambia a 'Usuario'
    }

    public function periodoAcademico()
{
    return $this->belongsTo(Periodo_academico::class, 'periodo_academico_id');
}
}