<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\ComentarioReporte;
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
            'id_comentario_respuesta' => 'nullable|exists:comentarios,id',
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

    public function reportar(Request $request, $id)
    {
        $request->validate([
            'razon' => 'nullable|string|max:500',
        ]);

        $comentario = Comentario::findOrFail($id);

        ComentarioReporte::create([
            'comentario_id' => $comentario->id,
            'usuario_id' => auth()->id(),
            'razon' => $request->razon,
        ]);

        return back()->with('success', 'Comentario reportado correctamente. Gracias por ayudar a mantener la comunidad.');
    }

}
