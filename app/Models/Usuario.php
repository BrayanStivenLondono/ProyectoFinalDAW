<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;


class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "nombre_usuario",
        "nombre",
        "apellido",
        "correo",
        "contrasena",
        "tipo",
        "biografia",
        "enlaces_sociales",
        "imagen_perfil",
    ];

    protected $hidden = [
        "contrasena",
        "remember_token",
    ];

    public function obras(): HasMany
    {
        return $this->hasMany(Obra::class, "id_artista");
    }

    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

    public function siguiendo()
    {
        return $this->belongsToMany(Usuario::class, 'seguidores', 'id_seguidor', 'id_seguido')
            ->withTimestamps()
            ->withPivot('fecha_seguimiento');
    }

    public function seguidores()
    {
        return $this->belongsToMany(Usuario::class, 'seguidores', 'id_seguido', 'id_seguidor')
            ->withTimestamps()
            ->withPivot('fecha_seguimiento');
    }

    public function reportesGenerados(): HasMany
    {
        return $this->hasMany(Reporte::class, "id_usuario");
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->nombre." ".$this->apellido);
    }

    // Función para obtener la ruta del perfil según si es artista o no
    public function perfilUrl()
    {
        if ($this->esArtista()) {
            return route('artista.perfil', ['slug' => $this->slug]);
        } else {
            return route('usuario.perfil.publico', ['slug' => $this->slug]);
        }
    }

    // Ejemplo simple de función esArtista

    public function likes()
    {
        return $this->belongsToMany(Obra::class, 'likes', 'usuario_id', 'obra_id');  // Cambiado el nombre de la clave foránea

    }

    // Métodos para distinguir entre artista y visitante
    public function esArtista()
    {
        return $this->tipo === 'artista';
    }

    public function esVisitante()
    {
        return $this->tipo === 'visitante';
    }

    protected static function booted()
    {
        static::saving(function ($usuario) {
            // Si el tipo no es artista, vaciamos la biografía
            if ($usuario->tipo !== 'artista') {
                $usuario->biografia = null;
            }
        });
    }

    public function favoritos()
    {
        return $this->belongsToMany(Obra::class, 'favoritos')->withTimestamps();
    }
}
