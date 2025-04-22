<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artista extends Model
{
    use HasFactory;

    protected $table = "artistas";

    protected $primaryKey = "id_artista";

    public $incrementing = false;

    protected $fillable = [
        "id_artista",
        "declaracion_artista",
        "estilo",
        "tecnica",
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_artista');
    }

    /**
     * Relacion uno a muchos con las obras del artista.
     */
    public function obras(): HasMany
    {
        return $this->hasMany(Obra::class, 'id_artista');
    }

    /**
     * Relacion muchos a muchos con los usuarios que siguen a este artista (sus seguidores).
     */
    public function seguidores()
    {
        return $this->belongsToMany(Usuario::class, 'seguidores', 'id_seguido', 'id_seguidor')->withTimestamps();
    }
}
