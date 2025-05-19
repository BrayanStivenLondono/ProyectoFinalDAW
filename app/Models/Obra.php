<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Obra extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'obras';

    protected $fillable = [
        'id_artista',
        'titulo',
        'estilo',
        'tecnica',
        'tipo',
        'año_creacion',
        'descripcion',
        'imagen',
        'metadatos_seo',
    ];

    /**
     * Relacion con el artista que creo la obra.
     */

    public function artista()
    {
        return $this->belongsTo(Usuario::class, 'id_artista');
    }

    /**
     * Relacion uno a muchos con los comentarios de la obra.
     */
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class, 'id_obra');

    }

    /**
     * Relacion polimorfica uno a muchos con los reportes de la obra.
     */
    public function reportes(): MorphMany
    {
        return $this->morphMany(Reporte::class, 'reportable');
    }

    /**
     * Relacion con los usuarios que han dado like a la obra.
     */

    public function usuarioDaLike(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'likes', 'obra_id', 'usuario_id');  // Cambiado el nombre de la clave foránea

    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

}
