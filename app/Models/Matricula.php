<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Matricula extends Model
{
    use HasFactory;
    use SoftDeletes;
protected $fillable = ['estado', 'registro_id'];

// Relación con Registro
public function registro()
{
    return $this->belongsTo(Registro::class);
}

// Relación con Grupo
public function grupo()
{
    return $this->belongsTo(Grupo::class);
}

// Relación con Usuario
public function usuario()
{
    return $this->belongsTo(Usuarios::class,'registro_id' );
}
}

