<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function artista(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_artista');
    }

    /**
     * Relacion uno a muchos con los comentarios de la obra.
     */
    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Relacion polimorfica uno a muchos con los reportes de la obra.
     */
    public function reportes(): MorphMany
    {
        return $this->morphMany(Reporte::class, 'reportable');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($obra) {
            $obra->titulo = Str::slug($obra->titulo);
        });
    }
}
