<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['usuario_id', 'obra_id'];  // Cambiado los nombres de las columnas

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');  // Cambiado el nombre de la clave foránea
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');  // Cambiado el nombre de la clave foránea
    }
}
