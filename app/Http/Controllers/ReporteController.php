<?php

namespace App\Http\Controllers;


use App\Models\ComentarioReporte;
use App\Models\Usuario;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = ComentarioReporte::with(['comentario', 'usuario'])->paginate(20);

        return view('reporte.index', compact('reportes'));

    }

    public function mostrar(ComentarioReporte $reporte)
    {
        $reporte->load(['comentario', 'usuario']);

        $usuario = $reporte->usuario;

        return view('reporte.verReporte', compact('reporte', 'usuario'));
    }

    public function aprobar(ComentarioReporte $reporte)
    {
        $reporte->comentario->delete();
        $reporte->delete();

        return redirect()->route('reportes.index')->with('success', 'Reporte aprobado y comentario eliminado.');
    }

    public function rechazar(ComentarioReporte $reporte)
    {
        $reporte->delete();

        return redirect()->route('reportes.index')->with('success', 'Reporte rechazado y eliminado.');
    }
}
