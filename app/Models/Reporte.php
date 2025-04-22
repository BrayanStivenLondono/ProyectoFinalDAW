<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';

    protected $fillable = [
        'id_usuario',
        'id_obra',
        'id_comentario',
        'motivo',
        'descripcion',
        'fecha_reporte',
    ];

    /**
     * Relacion con el usuario que realizo el reporte.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    /**
     * Relacion con la obra reportada (si existe).
     */
    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class, 'id_obra');
    }

    /**
     * Relacion con el comentario reportado (si existe).
     */
    public function comentario(): BelongsTo
    {
        return $this->belongsTo(Comentario::class, 'id_comentario');
    }
}
