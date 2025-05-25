<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioReporte extends Model
{
    use HasFactory;

    protected $table = 'comentarios_reportes';

    protected $fillable = ['comentario_id', 'usuario_id', 'razon'];

    public function comentario()
    {
        return $this->belongsTo(Comentario::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

}
