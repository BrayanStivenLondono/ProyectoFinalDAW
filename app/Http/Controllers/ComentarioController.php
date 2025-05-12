<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ComentarioController extends Controller
{

    public function index()
    {
        $comentarios = Comentario::all();
        return view("obra.verObra", compact("comentarios"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_obra' => 'required|exists:obras,id',
            'contenido' => 'required|string|max:1000',
        ]);

        Comentario::create([
            'id_usuario' => auth()->id(),
            'id_obra' => $request->input('id_obra'),
            'contenido' => $request->input('contenido'),
            'fecha_comentario' => now(),
            'id_comentario_respuesta' => $request->input('id_comentario_respuesta'),
        ]);

        return redirect()->back()->with('success', 'Comentario publicado.');
    }



}
