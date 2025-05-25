<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function agregar($idObra)
    {
        $obra = Obra::findOrFail($idObra);
        $usuario = auth()->user();

        // Verificar si ya está en favoritos
        if ($usuario->favoritos()->where('obra_id', $obra->id)->exists()) {
            return back()->with('info', 'La obra ya está en tus favoritos.');
        }

        $usuario->favoritos()->attach($obra->id);

        return back()->with('success', 'Obra agregada a tus favoritos.');
    }

    public function eliminar($idObra)
    {
        auth()->user()->favoritos()->detach($idObra);

        return back()->with('success', 'Obra eliminada de tus favoritos.');
    }

    public function verFavoritos()
    {
        $usuario = auth()->user();
        $favoritos = $usuario->favoritos()->latest()->get();

        return view('usuario.obrasFavoritas', compact('favoritos'));
    }


}
