<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bitacora extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'entidad_id',
        'entidad_type',
        'categoria',
        'descripcion',
        'archivo_evidencia',
        'notificar_padres',
        'user_id',
    ];

    // Relación polimórfica (a qué entidad pertenece)
    public function entidad()
    {
        return $this->morphTo();
    }

    // Quién registró la nota
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
