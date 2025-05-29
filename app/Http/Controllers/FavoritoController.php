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

    public function obrasArtistasFavoritos(Request $request)
    {
        $usuario = auth()->user();
        $q = $request->input('q');

        $obrasFavoritas = $usuario->favoritos()->latest()->get();
        $artistasSeguidos = $usuario->artistasSeguidos()->with('obras')->get();

        if ($q) {
            $obrasFavoritas = $obrasFavoritas->filter(function ($obra) use ($q) {
                return stripos($obra->titulo, $q) !== false;
            });

            $artistasSeguidos = $artistasSeguidos->filter(function ($artista) use ($q) {
                $nombreCompleto = $artista->nombre . ' ' . $artista->apellido;
                return stripos($nombreCompleto, $q) !== false;
            });
        }

        return view('usuario.obrasFavoritas', compact('obrasFavoritas', 'artistasSeguidos'));
    }


}
