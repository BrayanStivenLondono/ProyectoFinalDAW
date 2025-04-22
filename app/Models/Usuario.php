<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use HasFactory, Notifiable;
    //
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
        return $this->hasMany(Comentario::class);

    }

    public function siguiendo(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, "seguidores", "id_seguido", "id_seguidor")->withTimestamps();
    }

    public function reportesGenerados(): HasMany
    {
        return $this->hasMany(Reporte::class, "id_usuario");
    }

    public function artistaInfo(): HasOne
    {
        return $this->hasOne(Artista::class, "id_artista");

    }
}

