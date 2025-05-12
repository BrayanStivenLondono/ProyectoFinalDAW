<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comentario extends Model
{
    use HasFactory;

    protected $table = "comentarios";

    protected $fillable = [
        'id_usuario',
        'id_obra',
        'contenido',
        'fecha_comentario',
        'id_comentario_respuesta',
    ];


    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class, 'id_obra');
    }

    public function comentarioPadre(): BelongsTo
    {
        return $this->belongsTo(Comentario::class, 'id_comentario_respuesta');
    }

    public function respuestas(): HasMany
    {
        return $this->hasMany(Comentario::class, 'id_comentario_respuesta');
    }
}
