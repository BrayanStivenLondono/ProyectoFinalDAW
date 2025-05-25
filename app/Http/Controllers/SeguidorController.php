<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguidorController extends Controller
{
    public function seguir($idSeguido)
    {
        $usuario = auth()->user();

        if ($usuario->id == $idSeguido) {
            return redirect()->back()->with('error', 'No puedes seguirte a ti mismo.');
        }

        if (!$usuario->siguiendo->contains($idSeguido)) {
            $usuario->siguiendo()->attach($idSeguido, ['fecha_seguimiento' => now()]);
        }

        return redirect()->back()->with('success', 'Ahora sigues a este artista.');
    }

    public function dejarDeSeguir($idSeguido)
    {
        $usuario = auth()->user();
        $usuario->siguiendo()->detach($idSeguido);

        return redirect()->back()->with('success', 'Has dejado de seguir al artista.');
    }
}
