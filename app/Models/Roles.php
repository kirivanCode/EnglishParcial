<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['nombre'];

    // Relación uno a muchos con Usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuarios::class);
    }
}
