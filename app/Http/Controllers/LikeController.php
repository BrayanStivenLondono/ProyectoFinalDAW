<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike($obraId)
    {
        // Comprobar si el usuario está autenticado primero
        $user = Auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $obra = Obra::findOrFail($obraId);

        // Comprobar si el usuario ya dio like a la obra
        $yaDioLike = $user->likes()->where('obra_id', $obra->id)->exists();

        if ($yaDioLike) {
            // Si ya dio like, quitar el like
            $user->likes()->detach($obra->id);
        } else {
            // Si no dio like, agregar el like
            $user->likes()->attach($obra->id);
        }

        // Redirigir al usuario a la página anterior o realizar una respuesta AJAX
        return redirect()->back(); // o una respuesta JSON si es AJAX
    }

}
