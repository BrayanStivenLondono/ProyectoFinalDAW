<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seguidor extends Model
{
    use HasFactory;
    protected $table = 'seguidores';

    protected $primaryKey = ['id_seguidor', 'id_seguido'];

    public $incrementing = false;

    protected $fillable = [
        'id_seguidor',
        'id_seguido',
        'fecha_seguimiento',
    ];

    /**
     * Relacion con el usuario que sigue.
     */
    public function seguidor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_seguidor');
    }

    /**
     * Relacion con el usuario (artista) que es seguido.
     */
    public function seguido(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_seguido');
    }
}
