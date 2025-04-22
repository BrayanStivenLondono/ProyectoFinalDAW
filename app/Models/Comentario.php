<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comentario extends Model
{
    use HasFactory;

    protected $table = "comentario";

    protected $fillable = [
        "id_usuario",
        "id_obra",
        "contenido",
        "fecha_comentario",
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Relacion con la obra a la que pertenece el comentario.
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }

    public function reportes(): MorphMany
    {
        return $this->morphMany(Reporte::class, 'reportable');
    }
}
