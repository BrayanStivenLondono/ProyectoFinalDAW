<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Database\Seeders\ObraSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObraController extends Controller
{
    public function index()
    {
        //logica para el index de obra
    }

    public function carresulColecciones()
    {
        $obrasPorTipo = Obra::select('obras.*')
            ->join(DB::raw('(SELECT MIN(id) as id FROM obras GROUP BY tipo) as sub'), 'obras.id', '=', 'sub.id')
            ->whereNotNull('obras.tipo') // Filtra los registros donde tipo no es nulo
            ->where('obras.tipo', '!=', '') // Filtra los registros donde tipo no esté vacío
            ->get();


        $obras = Obra::latest()->take(5)->get();

        return view('index', compact('obrasPorTipo', 'obras'));
    }

    public function obtenerObrasPorTipo(string $tipo)
    {
        $obrasPorTipo = Obra::where('tipo', $tipo)->latest()->paginate(5);
        return view('obra.verColeccion', compact('obrasPorTipo', 'tipo'));
    }


    public function verTodasLasColecciones()
    {
        $obrasPorTipo = Obra::select('obras.*', DB::raw('(SELECT COUNT(*) FROM obras as o2 WHERE o2.tipo = obras.tipo) as total'))
            ->join(DB::raw('(SELECT MIN(id) as id FROM obras GROUP BY tipo) as sub'), 'obras.id', '=', 'sub.id')
            ->whereNotNull('obras.tipo')
            ->where('obras.tipo', '!=', '')
            ->orderBy('tipo')
            ->get();

        return view('obra.colecciones', compact('obrasPorTipo'));
    }

    public function verObra($slug)
    {
        $titulo = str_replace('-', ' ', $slug);

        $obra = Obra::whereRaw('LOWER(titulo) = ?', [strtolower($titulo)])->first();

        if (!$obra) {
            abort(404);
        }

        return view('obra.verObra', compact('obra'));
    }

}
